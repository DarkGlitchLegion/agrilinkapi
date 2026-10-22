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
        Schema::create('farm_crops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_id')->constrained()->onDelete('cascade');
            $table->foreignId('commodity_id')->constrained()->onDelete('cascade');
            $table->decimal('cultivated_area_hectares', 14, 3);
            $table->date('planting_date')->nullable();
            $table->date('expected_harvest_date')->nullable();
            $table->string('status')->default('growing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_crops');
    }
};
