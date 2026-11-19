<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Review;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        // Rank only eateries that have received a review.
        $topEateries = Eatery::with(['district', 'features'])
            ->has('reviews')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->orderBy('name')
            ->limit(3)
            ->get();

        // Pass the guide's current totals to the home page.
        return view('home', [
            'eateryCount' => Eatery::count(),
            'districtCount' => District::count(),
            'reviewCount' => Review::count(),
            'topEateries' => $topEateries,
        ]);
    }
}
