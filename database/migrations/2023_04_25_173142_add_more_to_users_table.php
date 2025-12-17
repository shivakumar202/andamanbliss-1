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
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable()->after('name');
            $table->string('mobile')->unique()->nullable()->after('surname');
            $table->timestamp('mobile_verified_at')->nullable()->after('mobile');
            $table->string('username')->unique()->after('email_verified_at');
            $table->date('dob')->nullable()->after('remember_token')->index();
            $table->string('sex')->nullable()->default('male')->comment('male, female', 'other')->after('dob')->index();
            $table->string('status')->nullable()->default('active')->comment('active, inactive, block')->after('sex')->index();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['surname', 'mobile', 'mobile_verified_at', 'username', 'dob', 'sex', 'status']);
            $table->dropSoftDeletes();
        });
    }
};
