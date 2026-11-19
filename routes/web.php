<?php

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EateryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ReviewerController;
use Illuminate\Support\Facades\Route;

// Show the guide's home page.
Route::get('/', HomeController::class)->name('home');

// Register the seven standard eatery actions.
Route::resource('eateries', EateryController::class);

// Post a review to an eatery or remove an existing review.
Route::post('/eateries/{eatery}/reviews', [ReviewController::class, 'store'])->name('eateries.reviews.store');
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

// Browse districts and see what an individual reviewer has written.
Route::get('/districts', [DistrictController::class, 'index'])->name('districts.index');
Route::get('/districts/{district}', [DistrictController::class, 'show'])->name('districts.show');
Route::get('/reviewers/{user}', [ReviewerController::class, 'show'])->name('reviewers.show');
