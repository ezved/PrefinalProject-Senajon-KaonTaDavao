<?php

// Put this class in its Laravel namespace.
namespace Database\Seeders;

// Import Seeder.
use Illuminate\Database\Seeder;


// Define the DatabaseSeeder.
class DatabaseSeeder extends Seeder
{
    // Define the run operation.
    public function run(): void
    {
        // Build reference data before records that need it.
        $this->call([
            DistrictSeeder::class,
            FeatureSeeder::class,
            UserSeeder::class,
            EaterySeeder::class,
            ReviewSeeder::class,
        ]);
    }
}

