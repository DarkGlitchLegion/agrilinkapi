<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('description')->nullable()->change();
            $table->unique('slug');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->string('description')->nullable()->change();
            $table->unique('slug');
        });

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->string('postal_code', 20)->using('postal_code::varchar')->change();
            $table->decimal('latitude', 10, 8)->nullable()->using("NULLIF(latitude, '')::numeric")->change();
            $table->decimal('longitude', 11, 8)->nullable()->using("NULLIF(longitude, '')::numeric")->change();
            $table->boolean('is_default')->default(false)->change();
        });

        Schema::table('user_preferences', function (Blueprint $table) {
            $table->string('preferred_notification_channel', 50)->default('email');
            $table->boolean('marketing_opt_in')->default(false);
        });

        Schema::table('verification_documents', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('document_type', 100)->nullable();
            $table->text('file_path')->nullable();
            $table->string('status')->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('verification_documents', function (Blueprint $table) {
            $table->dropForeign(['reviewed_by']);
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'document_type', 'file_path', 'status', 'reviewed_by']);
        });

        Schema::table('user_preferences', function (Blueprint $table) {
            $table->dropColumn(['preferred_notification_channel', 'marketing_opt_in']);
        });

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->integer('postal_code')->using('postal_code::integer')->change();
            $table->string('latitude')->nullable()->using('latitude::varchar')->change();
            $table->string('longitude')->nullable()->using('longitude::varchar')->change();
            $table->boolean('is_default')->change();
        });

        DB::table('user_addresses')->whereNull('latitude')->update(['latitude' => '']);
        DB::table('user_addresses')->whereNull('longitude')->update(['longitude' => '']);

        Schema::table('user_addresses', function (Blueprint $table) {
            $table->string('latitude')->nullable(false)->change();
            $table->string('longitude')->nullable(false)->change();
        });

        DB::table('roles')->whereNull('description')->update(['description' => '']);
        DB::table('permissions')->whereNull('description')->update(['description' => '']);

        Schema::table('roles', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->string('description')->nullable(false)->change();
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->string('description')->nullable(false)->change();
        });
    }
};
