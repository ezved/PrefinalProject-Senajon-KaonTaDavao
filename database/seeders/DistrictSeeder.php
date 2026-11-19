<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        // Add the six districts used by the guide.
        foreach (['Poblacion', 'Talomo', 'Agdao', 'Buhangin', 'Toril', 'Bunawan'] as $name) {
            District::create(['name' => $name]);
        }
    }
}

