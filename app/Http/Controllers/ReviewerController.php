<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class ReviewerController extends Controller
{
    public function show(User $user): View
    {
        // Load the review history and the eatery linked from each review.
        $user->load(['reviews' => fn ($query) => $query->with('eatery')->latest()->orderByDesc('id')]);

        return view('reviewers.show', compact('user'));
    }
}
