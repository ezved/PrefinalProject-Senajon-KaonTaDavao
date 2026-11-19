<?php

// Put this class in its Laravel namespace.
namespace Database\Factories;

// Import User.
use App\Models\User;
// Import Factory.
use Illuminate\Database\Eloquent\Factories\Factory;
// Import Hash.
use Illuminate\Support\Facades\Hash;
// Import Str.
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Return the values for this operation.
        return [
            // Use the display name.
            'name' => fake()->name(),
            // Set the email value.
            'email' => fake()->unique()->safeEmail(),
            // Set the email verified at value.
            'email_verified_at' => now(),
            // Set the password value.
            'password' => static::$password ??= Hash::make('password'),
            // Set the remember token value.
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        // Return the value provided by this relationship or request.
        return $this->state(fn (array $attributes) => [
            // Set the email verified at value.
            'email_verified_at' => null,
        ]);
    }
}
