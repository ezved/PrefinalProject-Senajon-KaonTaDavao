<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class District extends Model
{
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['name'];

    // Define the eateries relationship.
    public function eateries(): HasMany
    {
        return $this->hasMany(Eatery::class);
    }

    // Define the reviews relationship.
    public function reviews(): HasManyThrough
    {
        return $this->hasManyThrough(Review::class, Eatery::class);
    }
}

