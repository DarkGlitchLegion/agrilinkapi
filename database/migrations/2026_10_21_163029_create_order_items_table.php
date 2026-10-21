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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_listing_id')->constrained();
            $table->string('product_name_snapshot');
            $table->decimal('quantity', 14, 3);
            $table->foreignId('unit_id')->constrained('units_of_measure');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('line_total', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
