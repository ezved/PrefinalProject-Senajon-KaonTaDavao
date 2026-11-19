<?php

// Put this class in its Laravel namespace.
namespace App\Models;

// factory type used by HasFactory
use Database\Factories\UserFactory;
// attributes that set fillable and hidden columns
use Illuminate\Database\Eloquent\Attributes\Fillable;
// Import Hidden.
use Illuminate\Database\Eloquent\Attributes\Hidden;
// lets us use User::factory() in seeders
use Illuminate\Database\Eloquent\Factories\HasFactory;
// types for the relationship return values
use Illuminate\Database\Eloquent\Relations\HasMany;
// Import HasOne.
use Illuminate\Database\Eloquent\Relations\HasOne;
// base class for users that can log in
use Illuminate\Foundation\Auth\User as Authenticatable;
// Import Notifiable.
use Illuminate\Notifications\Notifiable;

// columns allowed for mass assignment
#[Fillable(['name', 'email', 'password'])]
// columns never shown when the user is turned into an array or json
#[Hidden(['password', 'remember_token'])]
// Define the User.
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // turn database values into real PHP types
    protected function casts(): array
    {
        // Return the values for this operation.
        return [
            // Set the email verified at value.
            'email_verified_at' => 'datetime', // text becomes a date object
            // Set the password value.
            'password' => 'hashed',            // plain passwords are hashed automatically
        ];
    }

    // the author profile of this user (authors.user_id), only Kagawads have one
    public function author(): HasOne
    {
        // one user -> at most one author profile
        return $this->hasOne(Author::class);
    }

    // all comments written by this user
    public function comments(): HasMany
    {
        // one user -> many comments
        return $this->hasMany(Comment::class);
    }

    // Find the reviews written by this user.
    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        // Return the value provided by this relationship or request.
        return $this->hasMany(Review::class);
    }
}
