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
        Schema::create('buyer_product_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('commodity_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity_required', 14, 3);
            $table->foreignId('unit_id')->constrained('units_of_measure');
            $table->decimal('target_price', 12, 2)->nullable();
            $table->date('needed_by')->nullable();
            $table->foreignId('delivery_barangay_id')->nullable()->constrained('barangays');
            $table->string('status')->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_product_requirements');
    }
};
