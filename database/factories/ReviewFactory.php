<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Eatery;
use App\Models\User;

class ReviewFactory extends Factory
{
    // Make sample review data for a fresh database.
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'user_id' => User::factory(),
            'rating' => fake()->numberBetween(1, 5),
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

