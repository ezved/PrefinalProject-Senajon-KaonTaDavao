<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Eatery;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Eatery $eatery): RedirectResponse
    {
        // The relationship fills the eatery ID for the review.
        $eatery->reviews()->create($request->validated());

        return to_route('eateries.show', $eatery)->with('status', 'Salamat! Review posted.');
    }

    public function destroy(Review $review): RedirectResponse
    {
        // Find the return page before removing the review.
        $review->load('eatery');
        $eatery = $review->eatery;
        $review->delete();

        return to_route('eateries.show', $eatery)->with('status', 'Review deleted.');
    }
}
