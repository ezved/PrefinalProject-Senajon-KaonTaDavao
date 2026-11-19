<?php

// Put this class in its Laravel namespace.
namespace App\Models;

// Import HasFactory.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import Model.
use Illuminate\Database\Eloquent\Model;
// Import HasMany.
use Illuminate\Database\Eloquent\Relations\HasMany;
// Import HasManyThrough.
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

// Define the District.
class District extends Model
{
    // Enable the Eloquent factory.
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['name'];

    // Define the eateries relationship.
    public function eateries(): HasMany
    {
        // Return the value provided by this relationship or request.
        return $this->hasMany(Eatery::class);
    }

    // Define the reviews relationship.
    public function reviews(): HasManyThrough
    {
        // Return the value provided by this relationship or request.
        return $this->hasManyThrough(Review::class, Eatery::class);
    }
}

