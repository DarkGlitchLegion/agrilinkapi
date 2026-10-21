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
        Schema::create('price_import_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')->constrained('data_sources');
            $table->string('file_path');
            $table->foreignId('imported_by')->constrained('users');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('finished_at')->nullable();
            $table->string('status')->default('processing');
            $table->integer('records_processed')->default(0);
            $table->jsonb('error_summary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_import_batches');
    }
};
