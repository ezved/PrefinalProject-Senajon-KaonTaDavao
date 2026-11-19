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
        Schema::create('eateries', function (Blueprint $table) {
            // Add the primary key.
            $table->id();
            // Link this record to its district.
            $table->foreignId('district_id')->constrained();
            // Use the display name.
            $table->string('name', 100)->unique();
            // Use the name to build the URL key.
            $table->string('slug')->unique();
            // Use the street address.
            $table->string('address');
            // Use the selected price category.
            $table->string('price_range');
            // Use the optional specialty.
            $table->string('specialty')->nullable();
            // Track whether this eatery accepts reviews.
            $table->boolean('is_open')->default(true);
            // Track creation and update times.
            $table->timestamps();
        });
    }

    // Define the down operation.
    public function down(): void
    {
        // Remove this table when rolling back.
        Schema::dropIfExists('eateries');
    }
};
