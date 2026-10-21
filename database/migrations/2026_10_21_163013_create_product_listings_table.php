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
        Schema::create('product_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->foreignId('commodity_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('variety')->nullable();
            $table->string('quality_grade')->nullable();
            $table->decimal('quantity_available', 14, 3);
            $table->foreignId('unit_id')->constrained('units_of_measure');
            $table->decimal('minimum_order_quantity', 14, 3)->default(0);
            $table->decimal('price_per_unit', 12, 2);
            $table->string('pricing_type'); // e.g., fixed, negotiable
            $table->date('harvest_date')->nullable();
            $table->date('available_until')->nullable();
            $table->string('status')->default('draft'); // draft, pending_review, published, reserved, sold_out, expired, rejected, archived
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_listings');
    }
};
