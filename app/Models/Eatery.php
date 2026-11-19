<?php

// Put this class in its Laravel namespace.
namespace App\Models;

// Import HasFactory.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import Model.
use Illuminate\Database\Eloquent\Model;
// Import BelongsTo.
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// Import HasOne.
use Illuminate\Database\Eloquent\Relations\HasOne;
// Import HasMany.
use Illuminate\Database\Eloquent\Relations\HasMany;
// Import BelongsToMany.
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Define the Eatery.
class Eatery extends Model
{
    // Enable the Eloquent factory.
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['district_id', 'name', 'slug', 'address', 'price_range', 'specialty', 'is_open'];

    // Convert database values to the types used by the application.
    protected function casts(): array
    {
        // Return the values for this operation.
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
        // Return the value provided by this relationship or request.
        return $this->belongsTo(District::class);
    }

    // Define the permit relationship.
    public function permit(): HasOne
    {
        // Return the value provided by this relationship or request.
        return $this->hasOne(Permit::class);
    }

    // Define the dishes relationship.
    public function dishes(): HasMany
    {
        // Return the value provided by this relationship or request.
        return $this->hasMany(Dish::class);
    }

    // Define the features relationship.
    public function features(): BelongsToMany
    {
        // Return the value provided by this relationship or request.
        return $this->belongsToMany(Feature::class);
    }

    // Define the reviews relationship.
    public function reviews(): HasMany
    {
        // Return the value provided by this relationship or request.
        return $this->hasMany(Review::class);
    }
}

