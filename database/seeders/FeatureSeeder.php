<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        // Add the feature choices shown on the eatery form.
        foreach (['Suki ni Senajon', 'Budget Meal', 'Halal', 'Open 24 Hours', 'Aircon', 'Takeout'] as $name) {
            Feature::create(['name' => $name]);
        }
    }
}

