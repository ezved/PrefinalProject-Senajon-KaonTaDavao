<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\View\View;

class DistrictController extends Controller
{
    public function index(): View
    {
        // Count eateries together with the district query.
        $districts = District::withCount('eateries')->orderBy('name')->get();

        return view('districts.index', compact('districts'));
    }

    public function show(District $district): View
    {
        // Count reviews through the district's eateries.
        $district->loadCount('reviews');

        // Prepare all the data each eatery card displays.
        $eateries = $district->eateries()->with(['district', 'features'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('name')
            ->get();

        return view('districts.show', compact('district', 'eateries'));
    }
}
