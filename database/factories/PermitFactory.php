<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Eatery;

class PermitFactory extends Factory
{
    // Make sample permit data for a fresh database.
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'permit_no' => 'DVO-2026-'.fake()->unique()->numberBetween(10000, 99999),
            'expires_on' => today()->addMonths(fake()->numberBetween(1, 14)),
        ];
    }

}

