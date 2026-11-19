<?php

// Put this class in its Laravel namespace.
namespace App\Models;

// Import HasFactory.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import Model.
use Illuminate\Database\Eloquent\Model;
// Import BelongsTo.
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Define the Review.
class Review extends Model
{
    // Enable the Eloquent factory.
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['eatery_id', 'user_id', 'rating', 'body'];

    // Define the eatery relationship.
    public function eatery(): BelongsTo
    {
        // Return the value provided by this relationship or request.
        return $this->belongsTo(Eatery::class);
    }

    // Define the user relationship.
    public function user(): BelongsTo
    {
        // Return the value provided by this relationship or request.
        return $this->belongsTo(User::class);
    }
}

