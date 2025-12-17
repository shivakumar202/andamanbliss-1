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
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable()->comment('tour, hotel, activity, cruise, cab, bike')->index();
            $table->string('name')->nullable()->index();
            $table->decimal('rate', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('price', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('fees', 8, 2)->nullable()->default(0.00)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addons');
    }
};
