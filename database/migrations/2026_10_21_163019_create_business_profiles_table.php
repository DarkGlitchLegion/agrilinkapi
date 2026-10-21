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
        Schema::create('business_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_profile_id')->constrained()->onDelete('cascade');
            $table->string('business_name');
            $table->string('business_type');
            $table->text('business_address');
            $table->string('business_email')->nullable();
            $table->string('business_phone')->nullable();
            $table->string('registration_reference')->nullable();
            $table->string('verification_status')->default('unverified');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_profiles');
    }
};
