<?php

// Put this class in its Laravel namespace.
namespace App\Models;

// Import HasFactory.
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Import Model.
use Illuminate\Database\Eloquent\Model;
// Import BelongsTo.
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Define the Permit.
class Permit extends Model
{
    // Enable the Eloquent factory.
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['eatery_id', 'permit_no', 'expires_on'];

    // Convert database values to the types used by the application.
    protected function casts(): array
    {
        // Return the values for this operation.
        return ['expires_on' => 'date'];
    }

    // Define the eatery relationship.
    public function eatery(): BelongsTo
    {
        // Return the value provided by this relationship or request.
        return $this->belongsTo(Eatery::class);
    }
}

