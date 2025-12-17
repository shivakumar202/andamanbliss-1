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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->string('type')->nullable()->comment('tour, hotel, activity, cruise, cab, bike')->index();
            $table->string('slug')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->decimal('adult_rate', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('adult_price', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('adult_fees', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('child_rate', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('child_price', 8, 2)->nullable()->default(0.00)->index();
            $table->decimal('child_fees', 8, 2)->nullable()->default(0.00)->index();
            $table->string('address')->nullable()->index();
            $table->string('gmap')->nullable()->index();
            $table->tinyInteger('featured')->nullable()->default(0)->comment('0, 1')->index();
            $table->tinyInteger('best_seller')->nullable()->default(0)->comment('0, 1')->index();
            $table->tinyInteger('ratings')->nullable()->default(5)->comment('1, 2, 3, 4, 5')->index();
            $table->integer('reviews_count')->nullable()->default(0)->index();
            $table->text('description')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('status')->nullable()->default('active')->comment('active, inactive')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
