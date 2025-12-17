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
        Schema::create('google_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('review_id')->unique();
            $table->string('reviewer_name');
            $table->string('profile_photo_url')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->timestamp('review_time')->nullable();
            $table->json('reviewer_photos')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_reviews');
    }
};
