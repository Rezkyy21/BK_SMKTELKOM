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
        Schema::table('classes', function (Blueprint $table) {
            // Add academic_year_id foreign key
            $table->foreignId('academic_year_id')
                  ->nullable()
                  ->constrained('academic_years')
                  ->onDelete('cascade');
        });

        // Drop the old academic_year string column
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn('academic_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('classes', function (Blueprint $table) {
            // Restore academic_year string column
            $table->string('academic_year')->default('2026/2027');
            // Drop foreign key and column
            $table->dropForeignIdFor('academic_years');
        });
    }
};
