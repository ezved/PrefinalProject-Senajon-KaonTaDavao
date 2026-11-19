<?php

// Put this class in its Laravel namespace.
namespace App\Http\Controllers;

// Import District.
use App\Models\District;
// Import Eatery.
use App\Models\Eatery;
// Import Review.
use App\Models\Review;
// Import View.
use Illuminate\View\View;

// Define the HomeController.
class HomeController extends Controller
{
    // Define the __invoke operation.
    public function __invoke(): View
    {
        // Rank only eateries that have received a review.
        $topEateries = Eatery::with(['district', 'features'])
            ->has('reviews')
            // Count records from the relationship.
            ->withCount('reviews')
            // Calculate the average rating in the query.
            ->withAvg('reviews', 'rating')
            // Sort the results for display.
            ->orderByDesc('reviews_avg_rating')
            // Sort the results for display.
            ->orderBy('name')
            // Keep only the requested number of results.
            ->limit(3)
            // Retrieve the matching records.
            ->get();

        // Pass the guide's current totals to the home page.
        return view('home', [
            // Set the eateryCount value.
            'eateryCount' => Eatery::count(),
            // Set the districtCount value.
            'districtCount' => District::count(),
            // Set the reviewCount value.
            'reviewCount' => Review::count(),
            // Set the topEateries value.
            'topEateries' => $topEateries,
        ]);
    }
}
