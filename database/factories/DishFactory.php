<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Eatery;

class DishFactory extends Factory
{
    // Make sample dish data for a fresh database.
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'name' => fake()->randomElement(['Pork Adobo', 'Chicken Inasal', 'Pancit Canton', 'Grilled Bangus', 'Mongo Guisado']),
            'price' => fake()->randomFloat(2, 35, 250),
            'is_bestseller' => fake()->boolean(25),
        ];
    }

}

