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
        Schema::create('features', function (Blueprint $table) {
            // Add the primary key.
            $table->id();
            // Use the display name.
            $table->string('name')->unique();
            // Track creation and update times.
            $table->timestamps();
        });
    }

    // Define the down operation.
    public function down(): void
    {
        // Remove this table when rolling back.
        Schema::dropIfExists('features');
    }
};
