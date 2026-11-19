<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Eatery extends Model
{
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['district_id', 'name', 'slug', 'address', 'price_range', 'specialty', 'is_open'];

    // Convert database values to the types used by the application.
    protected function casts(): array
    {
        return ['is_open' => 'boolean'];
    }

    // Use the readable slug in all eatery URLs.
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Define the district relationship.
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    // Define the permit relationship.
    public function permit(): HasOne
    {
        return $this->hasOne(Permit::class);
    }

    // Define the dishes relationship.
    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class);
    }

    // Define the features relationship.
    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    // Define the reviews relationship.
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}

