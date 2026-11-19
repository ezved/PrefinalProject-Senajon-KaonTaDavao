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
        Schema::create('reviews', function (Blueprint $table) {
            // Add the primary key.
            $table->id();
            // Link this record to its eatery.
            $table->foreignId('eatery_id')->constrained();
            // Link the review to its writer.
            $table->foreignId('user_id')->constrained();
            // Use the review rating.
            $table->unsignedTinyInteger('rating');
            // Use the review text.
            $table->text('body');
            // Track creation and update times.
            $table->timestamps();
        });
    }

    // Define the down operation.
    public function down(): void
    {
        // Remove this table when rolling back.
        Schema::dropIfExists('reviews');
    }
};
