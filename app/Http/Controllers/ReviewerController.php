<?php

// Put this class in its Laravel namespace.
namespace App\Http\Controllers;

// Import User.
use App\Models\User;
// Import View.
use Illuminate\View\View;

// Define the ReviewerController.
class ReviewerController extends Controller
{
    // Define the show operation.
    public function show(User $user): View
    {
        // Load the review history and the eatery linked from each review.
        $user->load(['reviews' => fn ($query) => $query->with('eatery')->latest()->orderByDesc('id')]);

        // Render the page with its data.
        return view('reviewers.show', compact('user'));
    }
}
