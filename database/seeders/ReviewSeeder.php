<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        // Add Tita's review and two more to the hand-made eatery.
        $personal = Eatery::where('slug', 'carinderia-ni-senajon')->firstOrFail();
        $tita = User::where('email', 'tita.senajon@kaonta.test')->firstOrFail();
        $personal->reviews()->create([
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Senajon.',
        ]);

        $reviewers = User::pluck('id');
        foreach ($reviewers->reject(fn ($id) => $id === $tita->id)->random(2) as $id) {
            Review::factory()->for($personal)->create(['user_id' => $id]);
        }

        // Leave closed eateries without reviews.
        $open = Eatery::where('is_open', true)->whereKeyNot($personal->id)->get();
        foreach ($open as $index => $eatery) {
            $count = fake()->numberBetween($index < 2 ? 1 : 0, 6);
            Review::factory()->for($eatery)->count($count)->state(
                fn () => ['user_id' => $reviewers->random()],
            )->create();
        }
    }
}

