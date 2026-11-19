<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dish extends Model
{
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['eatery_id', 'name', 'price', 'is_bestseller'];

    // Convert database values to the types used by the application.
    protected function casts(): array
    {
        return ['is_bestseller' => 'boolean', 'price' => 'decimal:2'];
    }

    // Define the eatery relationship.
    public function eatery(): BelongsTo
    {
        return $this->belongsTo(Eatery::class);
    }
}

