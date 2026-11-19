<?php

// Import Migration.
use Illuminate\Database\Migrations\Migration;
// Import Blueprint.
use Illuminate\Database\Schema\Blueprint;
// Import Schema.
use Illuminate\Support\Facades\Schema;

// Define the table migration.
return new class extends Migration
{
    // Define the up operation.
    public function up(): void
    {
        // Create the table and define its columns.
        Schema::create('eatery_feature', function (Blueprint $table) {
            // Link this record to its eatery.
            $table->foreignId('eatery_id')->constrained();
            // Link this record to its feature.
            $table->foreignId('feature_id')->constrained();
            // Keep each eatery and feature pair unique.
            $table->primary(['eatery_id', 'feature_id']);
        });
    }

    // Define the down operation.
    public function down(): void
    {
        // Remove this table when rolling back.
        Schema::dropIfExists('eatery_feature');
    }
};
