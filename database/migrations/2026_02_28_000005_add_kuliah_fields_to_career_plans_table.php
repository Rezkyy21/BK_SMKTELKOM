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
        Schema::table('career_plans', function (Blueprint $table) {
            // extra fields required when siswa memilih kategori kuliah
            $table->string('student_name')->nullable()->after('category');
            $table->string('nis')->nullable()->after('student_name');
            $table->string('class_name')->nullable()->after('nis');
            $table->integer('graduation_year')->nullable()->after('class_name');
            $table->string('campus_name')->nullable()->after('graduation_year');
            $table->string('study_program')->nullable()->after('campus_name');
            $table->integer('entrance_year')->nullable()->after('study_program');

            // tambahan untuk kategori kerja
            $table->integer('accepted_year')->nullable()->after('target_position');

            // tambahan untuk kategori usaha
            $table->string('business_type')->nullable()->after('accepted_year');
            $table->integer('established_year')->nullable()->after('business_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('career_plans', function (Blueprint $table) {
            $table->dropColumn([
                'student_name',
                'nis',
                'class_name',
                'graduation_year',
                'campus_name',
                'study_program',
                'entrance_year',
                'accepted_year',
                'business_type',
                'established_year',
            ]);
        });
    }
};
