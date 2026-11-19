<?php

// Put this class in its Laravel namespace.
namespace Database\Factories;

// Import Factory.
use Illuminate\Database\Eloquent\Factories\Factory;
// Import Eatery.
use App\Models\Eatery;

// Define the DishFactory.
class DishFactory extends Factory
{
    // Make sample dish data for a fresh database.
    public function definition(): array
    {
        // Return the values for this operation.
        return [
            // Link this record to its eatery.
            'eatery_id' => Eatery::factory(),
            // Use the display name.
            'name' => fake()->randomElement(['Pork Adobo', 'Chicken Inasal', 'Pancit Canton', 'Grilled Bangus', 'Mongo Guisado']),
            // Use the dish price.
            'price' => fake()->randomFloat(2, 35, 250),
            // Track whether the dish is a bestseller.
            'is_bestseller' => fake()->boolean(25),
        ];
    }

}

