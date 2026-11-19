<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Make the two named reviewers and ten additional choices.
        $password = Hash::make('kaonta2026');
        User::create(['name' => 'Lourrence Ed Senajon', 'email' => 'senajon@kaonta.test', 'password' => $password]);
        User::create(['name' => 'Tita Senajon', 'email' => 'tita.senajon@kaonta.test', 'password' => $password]);
        User::factory()->count(10)->create();
    }
}

