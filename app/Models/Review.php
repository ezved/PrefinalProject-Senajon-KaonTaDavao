<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['eatery_id', 'user_id', 'rating', 'body'];

    // Define the eatery relationship.
    public function eatery(): BelongsTo
    {
        return $this->belongsTo(Eatery::class);
    }

    // Define the user relationship.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

