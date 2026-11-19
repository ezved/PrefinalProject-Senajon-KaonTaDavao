<?php

// Put this class in its Laravel namespace.
namespace Database\Seeders;

// Import Seeder.
use Illuminate\Database\Seeder;
// Import Feature.
use App\Models\Feature;

// Define the FeatureSeeder.
class FeatureSeeder extends Seeder
{
    // Define the run operation.
    public function run(): void
    {
        // Add the feature choices shown on the eatery form.
        foreach (['Suki ni Senajon', 'Budget Meal', 'Halal', 'Open 24 Hours', 'Aircon', 'Takeout'] as $name) {
            // Save the new record.
            Feature::create(['name' => $name]);
        }
    }
}

