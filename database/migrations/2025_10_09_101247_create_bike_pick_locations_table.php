<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bike_pick_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., Port Blair
            $table->string('location'); // e.g., South Andaman
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('pick_location')->nullable();
            $table->decimal('range_km')->default(2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bike_pick_locations');
    }
};
