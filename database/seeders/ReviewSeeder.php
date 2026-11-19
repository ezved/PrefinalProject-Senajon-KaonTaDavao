<?php

// Put this class in its Laravel namespace.
namespace Database\Seeders;

// Import Seeder.
use Illuminate\Database\Seeder;
// Import Eatery.
use App\Models\Eatery;
// Import Review.
use App\Models\Review;
// Import User.
use App\Models\User;

// Define the ReviewSeeder.
class ReviewSeeder extends Seeder
{
    // Define the run operation.
    public function run(): void
    {
        // Add Tita's review and two more to the hand-made eatery.
        $personal = Eatery::where('slug', 'carinderia-ni-senajon')->firstOrFail();
        // Prepare the tita value for the next step.
        $tita = User::where('email', 'tita.senajon@kaonta.test')->firstOrFail();
        // Save the new record.
        $personal->reviews()->create([
            // Link the review to its writer.
            'user_id' => $tita->id,
            // Use the review rating.
            'rating' => 5,
            // Use the review text.
            'body' => 'Lami kaayo! Balik-balikan ni Tita Senajon.',
        ]);

        // Prepare the reviewers value for the next step.
        $reviewers = User::pluck('id');
        // Repeat these steps for each item.
        foreach ($reviewers->reject(fn ($id) => $id === $tita->id)->random(2) as $id) {
            // Save the new record.
            Review::factory()->for($personal)->create(['user_id' => $id]);
        }

        // Leave closed eateries without reviews.
        $open = Eatery::where('is_open', true)->whereKeyNot($personal->id)->get();
        // Repeat these steps for each item.
        foreach ($open as $index => $eatery) {
            // Prepare the count value for the next step.
            $count = fake()->numberBetween($index < 2 ? 1 : 0, 6);
            Review::factory()->for($eatery)->count($count)->state(
                fn () => ['user_id' => $reviewers->random()],
            // Save the new record.
            )->create();
        }
    }
}

