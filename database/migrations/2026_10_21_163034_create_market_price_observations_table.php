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
        Schema::create('market_price_observations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commodity_id')->constrained()->onDelete('cascade');
            $table->foreignId('market_id')->constrained()->onDelete('cascade');
            $table->foreignId('source_id')->constrained('data_sources')->onDelete('cascade');
            $table->string('price_type'); // farm-gate, wholesale, retail
            $table->decimal('minimum_price', 12, 2);
            $table->decimal('maximum_price', 12, 2);
            $table->decimal('average_price', 12, 2);
            $table->foreignId('unit_id')->constrained('units_of_measure');
            $table->date('observed_on');
            $table->timestamp('published_at')->nullable();
            $table->string('verification_status')->default('pending');
            $table->foreignId('submitted_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_price_observations');
    }
};
