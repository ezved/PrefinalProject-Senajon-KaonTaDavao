<?php

// Put this class in its Laravel namespace.
namespace Database\Seeders;

// Import Seeder.
use Illuminate\Database\Seeder;
// Import Dish.
use App\Models\Dish;
// Import District.
use App\Models\District;
// Import Eatery.
use App\Models\Eatery;
// Import Feature.
use App\Models\Feature;
// Import Permit.
use App\Models\Permit;
// Import Str.
use Illuminate\Support\Str;

// Define the EaterySeeder.
class EaterySeeder extends Seeder
{
    // Define the run operation.
    public function run(): void
    {
        // Enter the personal eatery and its details by hand.
        $name = 'Carinderia ni Senajon';
        // Save the new record.
        $eatery = Eatery::create([
            // Link this record to its district.
            'district_id' => District::where('name', 'Poblacion')->firstOrFail()->id,
            // Use the display name.
            'name' => $name,
            // Use the name to build the URL key.
            'slug' => Str::slug($name),
            // Use the street address.
            'address' => 'San Pedro St., Poblacion, Davao City',
            // Use the selected price category.
            'price_range' => 'budget',
            // Use the optional specialty.
            'specialty' => 'Tinolang Manok',
            // Track whether this eatery accepts reviews.
            'is_open' => true,
        ]);
        // Save exactly the selected feature IDs.
        $eatery->features()->sync(Feature::whereIn('name', ['Suki ni Senajon', 'Budget Meal'])->pluck('id'));
        // Save the new record.
        $eatery->permit()->create(['permit_no' => 'DVO-2026-1015', 'expires_on' => '2027-10-15']);
        $eatery->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120.00],
            ['name' => 'Durian Shake', 'price' => 75.00],
        ]);

        // Populate the guide with eleven open and three closed factory eateries.
        $others = Eatery::factory()->count(11)->create()
            // Save the new record.
            ->concat(Eatery::factory()->closed()->count(3)->create());
        // Prepare the features value for the next step.
        $features = Feature::pluck('id');

        // Repeat these steps for each item.
        foreach ($others as $index => $other) {
            // Give the first factory eatery an expired permit.
            $permit = Permit::factory()->for($other);
            // Run the next step only when this condition is met.
            if ($index === 0) {
                // Prepare the permit value for the next step.
                $permit = $permit->state(['expires_on' => today()->subDay()]);
            }
            // Save the new record.
            $permit->create();
            // Save the new record.
            Dish::factory()->for($other)->count(fake()->numberBetween(2, 5))->create();
            // Link the selected features through the pivot.
            $other->features()->attach($features->random(fake()->numberBetween(1, 3))->all());
        }
    }
}

