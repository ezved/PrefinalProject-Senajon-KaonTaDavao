<?php

// Put this class in its Laravel namespace.
namespace App\Models;

// Import HasFactory.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import Model.
use Illuminate\Database\Eloquent\Model;
// Import BelongsToMany.
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Define the Feature.
class Feature extends Model
{
    // Enable the Eloquent factory.
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['name'];

    // Define the eateries relationship.
    public function eateries(): BelongsToMany
    {
        // Return the value provided by this relationship or request.
        return $this->belongsToMany(Eatery::class);
    }
}

