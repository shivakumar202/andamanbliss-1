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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('mobile')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('package_type')->nullable()->index();
            $table->string('hotel_type')->nullable()->index();
            $table->string('flight_ticket')->nullable()->default('have')->comment('have, need')->index();
            $table->string('lead_source')->nullable()->default('direct')->comment('direct, ads, facebook, instagram, agent, others')->index();
            $table->string('city')->nullable()->index();
            $table->string('duration')->nullable()->index();
            $table->date('travel_start')->nullable()->index();
            $table->date('travel_end')->nullable()->index();
            $table->tinyInteger('adult')->nullable()->default(1)->index();
            $table->tinyInteger('child')->nullable()->default(0)->index();
            $table->decimal('price_min', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('price_max', 8, 2)->nullable()->default(0.00)->index();
            $table->text('details')->nullable();
            $table->string('status')->nullable()->default('active')->comment('active, inactive')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
