<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;

    // Allow these attributes to be set together.
    protected $fillable = ['name'];

    // Define the eateries relationship.
    public function eateries(): BelongsToMany
    {
        return $this->belongsToMany(Eatery::class);
    }
}

