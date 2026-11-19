<?php

// Put this class in its Laravel namespace.
namespace App\Http\Controllers;

// Import StoreReviewRequest.
use App\Http\Requests\StoreReviewRequest;
// Import Eatery.
use App\Models\Eatery;
// Import Review.
use App\Models\Review;
// Import RedirectResponse.
use Illuminate\Http\RedirectResponse;

// Define the ReviewController.
class ReviewController extends Controller
{
    // Define the store operation.
    public function store(StoreReviewRequest $request, Eatery $eatery): RedirectResponse
    {
        // The relationship fills the eatery ID for the review.
        $eatery->reviews()->create($request->validated());

        // Fetch the related data in advance.
        return to_route('eateries.show', $eatery)->with('status', 'Salamat! Review posted.');
    }

    // Define the destroy operation.
    public function destroy(Review $review): RedirectResponse
    {
        // Find the return page before removing the review.
        $review->load('eatery');
        // Prepare the eatery value for the next step.
        $eatery = $review->eatery;
        // Remove the matching database rows.
        $review->delete();

        // Fetch the related data in advance.
        return to_route('eateries.show', $eatery)->with('status', 'Review deleted.');
    }
}
