<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EateryController extends Controller
{
    public function index(Request $request): View
    {
        // Read the three filters from the query string.
        $q = trim($request->string('q')->toString());
        $districtId = $request->integer('district');
        $featureName = $request->string('feature')->toString();

        // Group the two search conditions so the selected filters still apply.
        $eateries = Eatery::with(['district', 'features'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->when($q !== '', fn ($query) => $query->where(
                fn ($search) => $search->where('name', 'like', "%{$q}%")
                    ->orWhere('specialty', 'like', "%{$q}%")
            ))
            ->when($districtId, fn ($query) => $query->where('district_id', $districtId))
            ->when($featureName !== '', fn ($query) => $query->whereHas(
                'features', fn ($features) => $features->where('name', $featureName)
            ))
            ->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        // Provide the select lists and the values currently selected.
        return view('eateries.index', [
            'eateries' => $eateries,
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
            'q' => $q,
            'districtId' => $districtId,
            'featureName' => $featureName,
        ]);
    }

    public function create(): View
    {
        // Supply default values and choices for the shared form.
        return view('eateries.create', [
            'eatery' => new Eatery(['is_open' => true]),
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
            'selectedFeatures' => [],
        ]);
    }

    public function store(StoreEateryRequest $request): RedirectResponse
    {
        // Save the eatery and its related records together.
        $eatery = new Eatery;
        $this->saveEatery($eatery, $request->validated());

        return to_route('eateries.show', $eatery)->with('status', 'Eatery added.');
    }

    public function show(Eatery $eatery): View
    {
        // Load all related details before rendering the page.
        $eatery->load([
            'district', 'features', 'permit', 'dishes',
            'reviews' => fn ($query) => $query->with('user')->latest()->orderByDesc('id'),
        ]);

        // Only query the reviewer choices when their form is visible.
        $users = $eatery->is_open ? User::orderBy('name')->get() : collect();

        return view('eateries.show', compact('eatery', 'users'));
    }

    public function edit(Eatery $eatery): View
    {
        // Load the saved permit and feature choices for the form.
        $eatery->load(['permit', 'features']);

        return view('eateries.edit', [
            'eatery' => $eatery,
            'districts' => District::orderBy('name')->get(),
            'features' => Feature::orderBy('name')->get(),
            'selectedFeatures' => $eatery->features->modelKeys(),
        ]);
    }

    public function update(UpdateEateryRequest $request, Eatery $eatery): RedirectResponse
    {
        // Redirect with the current slug in case the eatery was renamed.
        $this->saveEatery($eatery, $request->validated());

        return to_route('eateries.show', $eatery)->with('status', 'Eatery updated.');
    }

    public function destroy(Eatery $eatery): RedirectResponse
    {
        // Remove dependent rows before deleting the eatery.
        DB::transaction(function () use ($eatery) {
            $eatery->features()->detach();
            $eatery->reviews()->delete();
            $eatery->dishes()->delete();
            $eatery->permit()->delete();
            $eatery->delete();
        });

        return to_route('eateries.index')->with('status', 'Eatery deleted.');
    }

    private function saveEatery(Eatery $eatery, array $data): void
    {
        // Keep eatery, permit, and feature changes in the same transaction.
        DB::transaction(function () use ($eatery, $data) {
            $eatery->fill(Arr::except($data, ['permit_no', 'expires_on', 'features']));
            $eatery->slug = Str::slug($data['name']);
            $eatery->save();
            $eatery->permit()->updateOrCreate([], Arr::only($data, ['permit_no', 'expires_on']));
            $eatery->features()->sync($data['features']);
        });
    }
}
