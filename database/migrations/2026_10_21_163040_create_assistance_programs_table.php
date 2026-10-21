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
        Schema::create('assistance_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('provider_name');
            $table->text('eligibility')->nullable();
            $table->text('application_instructions')->nullable();
            $table->string('official_url')->nullable();
            $table->timestamp('opens_at')->nullable();
            $table->timestamp('deadline_at')->nullable();
            $table->string('status')->default('published');
            $table->foreignId('published_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assistance_programs');
    }
};
