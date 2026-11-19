<?php

// Put this class in its Laravel namespace.
namespace Database\Factories;

// Import Factory.
use Illuminate\Database\Eloquent\Factories\Factory;
// Import District.
use App\Models\District;
// Import Str.
use Illuminate\Support\Str;

// Define the EateryFactory.
class EateryFactory extends Factory
{
    // Make sample eatery data for a fresh database.
    public function definition(): array
    {
        // Prepare the name value for the next step.
        $name = fake()->unique()->randomElement([
            'Balay sa Sabaw', 'Dabaw Bites', 'Dampa sa Kanto', 'Hapag ni Inday',
            'Ihaw sa Dalan', 'Kusina sa Umaga', 'Lamesa ni Nena', 'Lutong Bahay sa Kanto',
            'Merienda Corner', 'Panyapon sa Dabaw', 'Sabaw Station', 'Salo-Salo Kitchen',
            'Sugba sa Plaza', 'Tinola House', 'Timpla Kitchen', 'Ulam sa Plaza',
        ]);

        // Return the values for this operation.
        return [
            // Link this record to its district.
            'district_id' => District::inRandomOrder()->firstOrFail()->id,
            // Use the display name.
            'name' => $name,
            // Use the name to build the URL key.
            'slug' => Str::slug($name),
            // Use the street address.
            'address' => fake()->buildingNumber().' '.fake()->randomElement(['Rizal St.', 'Bonifacio St.', 'Mabini St.', 'Quezon Blvd.']).', Davao City',
            // Use the selected price category.
            'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
            // Use the optional specialty.
            'specialty' => fake()->randomElement(['Kinilaw na Tuna', 'Pork Adobo', 'Chicken Inasal', 'Beef Nilaga', 'Durian Shake', 'Pancit Canton']),
            // Track whether this eatery accepts reviews.
            'is_open' => true,
        ];
    }

    // Override the default open status for closed eateries.
    public function closed(): static
    {
        // Return the value provided by this relationship or request.
        return $this->state(['is_open' => false]);
    }
}

