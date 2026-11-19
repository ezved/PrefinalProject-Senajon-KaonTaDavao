<?php

// Put this class in its Laravel namespace.
namespace Database\Seeders;

// Import Seeder.
use Illuminate\Database\Seeder;
// Import User.
use App\Models\User;
// Import Hash.
use Illuminate\Support\Facades\Hash;

// Define the UserSeeder.
class UserSeeder extends Seeder
{
    // Define the run operation.
    public function run(): void
    {
        // Make the two named reviewers and ten additional choices.
        $password = Hash::make('kaonta2026');
        // Save the new record.
        User::create(['name' => 'Lourrence Ed Senajon', 'email' => 'senajon@kaonta.test', 'password' => $password]);
        // Save the new record.
        User::create(['name' => 'Tita Senajon', 'email' => 'tita.senajon@kaonta.test', 'password' => $password]);
        // Save the new record.
        User::factory()->count(10)->create();
    }
}

