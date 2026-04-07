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

        // Drop FK on major_id (it depends on classes_unique index), then drop the index and column
        Schema::table('classes', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropUnique('classes_unique');
            $table->dropColumn('academic_year');
            // Re-add the foreign key on major_id
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade');
            // Re-add unique index without academic_year
            $table->unique(['major_id', 'grade_level', 'name', 'academic_year_id'], 'classes_unique');
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
