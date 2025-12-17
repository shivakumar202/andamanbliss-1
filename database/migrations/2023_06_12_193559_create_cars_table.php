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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('reg_no')->unique();
            $table->date('reg_date')->nullable()->index();
            $table->string('fuel')->nullable()->default('diesel')->comment('electric, petrol, diesel')->index();
            $table->integer('cc')->nullable()->index();
            $table->tinyInteger('seat')->nullable()->index();
            $table->string('ac')->nullable()->default('no')->comment('yes, no')->index();
            $table->string('status')->nullable()->default('active')->comment('active, inactive')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
