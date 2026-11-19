<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\District;
use Illuminate\Support\Str;

class EateryFactory extends Factory
{
    // Make sample eatery data for a fresh database.
    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Balay sa Sabaw', 'Dabaw Bites', 'Dampa sa Kanto', 'Hapag ni Inday',
            'Ihaw sa Dalan', 'Kusina sa Umaga', 'Lamesa ni Nena', 'Lutong Bahay sa Kanto',
            'Merienda Corner', 'Panyapon sa Dabaw', 'Sabaw Station', 'Salo-Salo Kitchen',
            'Sugba sa Plaza', 'Tinola House', 'Timpla Kitchen', 'Ulam sa Plaza',
        ]);

        return [
            'district_id' => District::inRandomOrder()->firstOrFail()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => fake()->buildingNumber().' '.fake()->randomElement(['Rizal St.', 'Bonifacio St.', 'Mabini St.', 'Quezon Blvd.']).', Davao City',
            'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
            'specialty' => fake()->randomElement(['Kinilaw na Tuna', 'Pork Adobo', 'Chicken Inasal', 'Beef Nilaga', 'Durian Shake', 'Pancit Canton']),
            'is_open' => true,
        ];
    }

    // Override the default open status for closed eateries.
    public function closed(): static
    {
        return $this->state(['is_open' => false]);
    }
}

