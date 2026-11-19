<?php

// Put this class in its Laravel namespace.
namespace App\Models;

// Import HasFactory.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import Model.
use Illuminate\Database\Eloquent\Model;
// Import BelongsTo.
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Define the Dish.
class Dish extends Model
{
    // Enable the Eloquent factory.
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['eatery_id', 'name', 'price', 'is_bestseller'];

    // Convert database values to the types used by the application.
    protected function casts(): array
    {
        // Return the values for this operation.
        return ['is_bestseller' => 'boolean', 'price' => 'decimal:2'];
    }

    // Define the eatery relationship.
    public function eatery(): BelongsTo
    {
        // Return the value provided by this relationship or request.
        return $this->belongsTo(Eatery::class);
    }
}

