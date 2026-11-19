<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permit extends Model
{
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['eatery_id', 'permit_no', 'expires_on'];

    // Convert database values to the types used by the application.
    protected function casts(): array
    {
        return ['expires_on' => 'date'];
    }

    // Define the eatery relationship.
    public function eatery(): BelongsTo
    {
        return $this->belongsTo(Eatery::class);
    }
}

