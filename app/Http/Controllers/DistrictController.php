<?php

// Put this class in its Laravel namespace.
namespace App\Http\Controllers;

// Import District.
use App\Models\District;
// Import View.
use Illuminate\View\View;

// Define the DistrictController.
class DistrictController extends Controller
{
    // Define the index operation.
    public function index(): View
    {
        // Count eateries together with the district query.
        $districts = District::withCount('eateries')->orderBy('name')->get();

        // Render the page with its data.
        return view('districts.index', compact('districts'));
    }

    // Define the show operation.
    public function show(District $district): View
    {
        // Count reviews through the district's eateries.
        $district->loadCount('reviews');

        // Prepare all the data each eatery card displays.
        $eateries = $district->eateries()->with(['district', 'features'])
            // Count records from the relationship.
            ->withCount('reviews')
            // Calculate the average rating in the query.
            ->withAvg('reviews', 'rating')
            // Sort the results for display.
            ->orderBy('name')
            // Retrieve the matching records.
            ->get();

        // Render the page with its data.
        return view('districts.show', compact('district', 'eateries'));
    }
}
