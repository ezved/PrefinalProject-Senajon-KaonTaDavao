<?php

// Put this class in its Laravel namespace.
namespace App\Http\Controllers;

// Import StoreEateryRequest.
use App\Http\Requests\StoreEateryRequest;
// Import UpdateEateryRequest.
use App\Http\Requests\UpdateEateryRequest;
// Import District.
use App\Models\District;
// Import Eatery.
use App\Models\Eatery;
// Import Feature.
use App\Models\Feature;
// Import User.
use App\Models\User;
// Import RedirectResponse.
use Illuminate\Http\RedirectResponse;
// Import Request.
use Illuminate\Http\Request;
// Import Arr.
use Illuminate\Support\Arr;
// Import DB.
use Illuminate\Support\Facades\DB;
// Import Str.
use Illuminate\Support\Str;
// Import View.
use Illuminate\View\View;

// Define the EateryController.
class EateryController extends Controller
{
    // Define the index operation.
    public function index(Request $request): View
    {
        // Read the three filters from the query string.
        $q = trim($request->string('q')->toString());
        // Prepare the district id value for the next step.
        $districtId = $request->integer('district');
        // Prepare the feature name value for the next step.
        $featureName = $request->string('feature')->toString();

        // Group the two search conditions so the selected filters still apply.
        $eateries = Eatery::with(['district', 'features'])
            // Count records from the relationship.
            ->withCount('reviews')
            // Calculate the average rating in the query.
            ->withAvg('reviews', 'rating')
            // Apply this condition only when its filter has a value.
            ->when($q !== '', fn ($query) => $query->where(
                fn ($search) => $search->where('name', 'like', "%{$q}%")
                    ->orWhere('specialty', 'like', "%{$q}%")
            ))
            // Apply this condition only when its filter has a value.
            ->when($districtId, fn ($query) => $query->where('district_id', $districtId))
            // Apply this condition only when its filter has a value.
            ->when($featureName !== '', fn ($query) => $query->whereHas(
                'features', fn ($features) => $features->where('name', $featureName)
            ))
            // Sort the results for display.
            ->orderBy('name')
            // Show six eateries per page.
            ->paginate(6)
            // Carry the current filters into pagination links.
            ->withQueryString();

        // Provide the select lists and the values currently selected.
        return view('eateries.index', [
            // Set the eateries value.
            'eateries' => $eateries,
            // Set the districts value.
            'districts' => District::orderBy('name')->get(),
            // Use the selected eatery features.
            'features' => Feature::orderBy('name')->get(),
            // Set the q value.
            'q' => $q,
            // Set the districtId value.
            'districtId' => $districtId,
            // Set the featureName value.
            'featureName' => $featureName,
        ]);
    }

    // Define the create operation.
    public function create(): View
    {
        // Supply default values and choices for the shared form.
        return view('eateries.create', [
            // Set the eatery value.
            'eatery' => (new Eatery(['is_open' => true]))->setRelation('permit', null),
            // Set the districts value.
            'districts' => District::orderBy('name')->get(),
            // Use the selected eatery features.
            'features' => Feature::orderBy('name')->get(),
            // Set the selectedFeatures value.
            'selectedFeatures' => [],
        ]);
    }

    // Define the store operation.
    public function store(StoreEateryRequest $request): RedirectResponse
    {
        // Save the eatery and its related records together.
        $eatery = new Eatery;
        $this->saveEatery($eatery, $request->validated());

        // Fetch the related data in advance.
        return to_route('eateries.show', $eatery)->with('status', 'Eatery added.');
    }

    // Define the show operation.
    public function show(Eatery $eatery): View
    {
        // Load all related details before rendering the page.
        $eatery->load([
            'district', 'features', 'permit', 'dishes',
            // Set the reviews value.
            'reviews' => fn ($query) => $query->with('user')->latest()->orderByDesc('id'),
        ]);

        // Only query the reviewer choices when their form is visible.
        $users = $eatery->is_open ? User::orderBy('name')->get() : collect();

        // Render the page with its data.
        return view('eateries.show', compact('eatery', 'users'));
    }

    // Define the edit operation.
    public function edit(Eatery $eatery): View
    {
        // Load the saved permit and feature choices for the form.
        $eatery->load(['permit', 'features']);

        // Render the page with its data.
        return view('eateries.edit', [
            // Set the eatery value.
            'eatery' => $eatery,
            // Set the districts value.
            'districts' => District::orderBy('name')->get(),
            // Use the selected eatery features.
            'features' => Feature::orderBy('name')->get(),
            // Set the selectedFeatures value.
            'selectedFeatures' => $eatery->features->modelKeys(),
        ]);
    }

    // Define the update operation.
    public function update(UpdateEateryRequest $request, Eatery $eatery): RedirectResponse
    {
        // Redirect with the current slug in case the eatery was renamed.
        $this->saveEatery($eatery, $request->validated());

        // Fetch the related data in advance.
        return to_route('eateries.show', $eatery)->with('status', 'Eatery updated.');
    }

    // Define the destroy operation.
    public function destroy(Eatery $eatery): RedirectResponse
    {
        // Remove dependent rows before deleting the eatery.
        DB::transaction(function () use ($eatery) {
            // Remove the links from the pivot.
            $eatery->features()->detach();
            // Remove the matching database rows.
            $eatery->reviews()->delete();
            // Remove the matching database rows.
            $eatery->dishes()->delete();
            // Remove the matching database rows.
            $eatery->permit()->delete();
            // Remove the matching database rows.
            $eatery->delete();
        });

        // Fetch the related data in advance.
        return to_route('eateries.index')->with('status', 'Eatery deleted.');
    }

    // Define the save eatery operation.
    private function saveEatery(Eatery $eatery, array $data): void
    {
        // Keep eatery, permit, and feature changes in the same transaction.
        DB::transaction(function () use ($eatery, $data) {
            $eatery->fill(Arr::except($data, ['permit_no', 'expires_on', 'features']));
            $eatery->slug = Str::slug($data['name']);
            // Write the updated model to the database.
            $eatery->save();
            $eatery->permit()->updateOrCreate([], Arr::only($data, ['permit_no', 'expires_on']));
            // Save exactly the selected feature IDs.
            $eatery->features()->sync($data['features']);
        });
    }
}
