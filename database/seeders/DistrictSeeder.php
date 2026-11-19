<?php

// Put this class in its Laravel namespace.
namespace Database\Seeders;

// Import Seeder.
use Illuminate\Database\Seeder;
// Import District.
use App\Models\District;

// Define the DistrictSeeder.
class DistrictSeeder extends Seeder
{
    // Define the run operation.
    public function run(): void
    {
        // Add the six districts used by the guide.
        foreach (['Poblacion', 'Talomo', 'Agdao', 'Buhangin', 'Toril', 'Bunawan'] as $name) {
            // Save the new record.
            District::create(['name' => $name]);
        }
    }
}

