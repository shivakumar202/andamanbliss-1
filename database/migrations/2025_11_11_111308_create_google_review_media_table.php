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
        Schema::create('google_review_media', function (Blueprint $table) {
           $table->id();
            $table->foreignId('google_review_id')->constrained('google_reviews')->onDelete('cascade');
            $table->string('google_url');
            $table->string('media_format')->nullable();
            $table->timestamp('create_time')->nullable();
            $table->timestamps();
            $table->unique(['google_review_id', 'google_url']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_review_media');
    }
};
