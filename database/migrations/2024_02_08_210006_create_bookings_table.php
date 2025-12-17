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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('booking_id')->nullable()->default(0)->index();
            $table->unsignedBigInteger('table_id')->nullable()->index();
            $table->string('table_type')->nullable()->comment('services, addons')->index();
            $table->string('type')->nullable()->comment('tour, hotel, activity, cruise, cab, bike')->index();
            $table->bigInteger('room_id')->nullable()->default(0)->index();
            $table->string('food_choice')->nullable()->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->string('surname')->nullable()->index();
            $table->string('mobile')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('address')->nullable()->index();
            $table->decimal('rate', 8, 2)->nullable()->default(0.00)->index();
            $table->tinyInteger('quantity')->nullable()->default(1)->index();
            $table->decimal('price', 8, 2)->nullable()->default(0.00)->index();
            $table->tinyInteger('adult')->nullable()->default(1)->index();
            $table->tinyInteger('child')->nullable()->default(0)->index();
            $table->date('start_at')->nullable()->index();
            $table->date('end_at')->nullable()->index();
            $table->string('location')->nullable()->index();
            $table->string('destination')->nullable()->index();
            $table->text('note')->nullable();
            $table->string('status')->nullable()->default('active')->comment('active, inactive')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
