<?php

// Put this class in its Laravel namespace.
namespace Database\Factories;

// Import Factory.
use Illuminate\Database\Eloquent\Factories\Factory;
// Import Eatery.
use App\Models\Eatery;
// Import User.
use App\Models\User;

// Define the ReviewFactory.
class ReviewFactory extends Factory
{
    // Make sample review data for a fresh database.
    public function definition(): array
    {
        // Return the values for this operation.
        return [
            // Link this record to its eatery.
            'eatery_id' => Eatery::factory(),
            // Link the review to its writer.
            'user_id' => User::factory(),
            // Use the review rating.
            'rating' => fake()->numberBetween(1, 5),
            // Use the review text.
            'body' => fake()->randomElement([
                'The portions were generous and the food came out warm.',
                'A convenient stop for lunch. I enjoyed the daily special.',
                'I came with friends and we shared several dishes.',
                'Service was friendly and the meal was easy on the budget.',
                'The lunch crowd was busy, but the food was worth the wait.',
            ]),
        ];
    }

}

