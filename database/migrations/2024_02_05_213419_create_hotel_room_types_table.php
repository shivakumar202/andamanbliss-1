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
        Schema::create('hotel_room_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hotel_id')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->decimal('breakfast_rate', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('breakfast_price', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('breakfast_fees', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('dinner_rate', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('dinner_price', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('dinner_fees', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('lunch_rate', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('lunch_price', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('lunch_fees', 8, 2)->nullable()->default(0.00)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_room_types');
    }
};
