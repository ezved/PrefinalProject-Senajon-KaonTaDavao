<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        // Enter the personal eatery and its details by hand.
        $name = 'Carinderia ni Senajon';
        $eatery = Eatery::create([
            'district_id' => District::where('name', 'Poblacion')->firstOrFail()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);
        $eatery->features()->sync(Feature::whereIn('name', ['Suki ni Senajon', 'Budget Meal'])->pluck('id'));
        $eatery->permit()->create(['permit_no' => 'DVO-2026-1015', 'expires_on' => '2027-10-15']);
        $eatery->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120.00],
            ['name' => 'Durian Shake', 'price' => 75.00],
        ]);

        // Populate the guide with eleven open and three closed factory eateries.
        $others = Eatery::factory()->count(11)->create()
            ->concat(Eatery::factory()->closed()->count(3)->create());
        $features = Feature::pluck('id');

        foreach ($others as $index => $other) {
            // Give the first factory eatery an expired permit.
            $permit = Permit::factory()->for($other);
            if ($index === 0) {
                $permit = $permit->state(['expires_on' => today()->subDay()]);
            }
            $permit->create();
            Dish::factory()->for($other)->count(fake()->numberBetween(2, 5))->create();
            $other->features()->attach($features->random(fake()->numberBetween(1, 3))->all());
        }
    }
}

