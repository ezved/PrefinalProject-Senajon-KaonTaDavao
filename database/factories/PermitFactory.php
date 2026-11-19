<?php

// Put this class in its Laravel namespace.
namespace Database\Factories;

// Import Factory.
use Illuminate\Database\Eloquent\Factories\Factory;
// Import Eatery.
use App\Models\Eatery;

// Define the PermitFactory.
class PermitFactory extends Factory
{
    // Make sample permit data for a fresh database.
    public function definition(): array
    {
        // Return the values for this operation.
        return [
            // Link this record to its eatery.
            'eatery_id' => Eatery::factory(),
            // Use the permit number.
            'permit_no' => 'DVO-2026-'.fake()->unique()->numberBetween(10000, 99999),
            // Use the date the permit expires.
            'expires_on' => today()->addMonths(fake()->numberBetween(1, 14)),
        ];
    }

}

