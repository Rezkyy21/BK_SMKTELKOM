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
        Schema::table('laporan', function (Blueprint $table) {
            // Drop existing foreign key if exists
            try {
                $table->dropForeign(['siswa_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist, continue
            }

            try {
                $table->dropForeign(['guru_id']);
            } catch (\Exception $e) {
                // Foreign key might not exist, continue
            }

            // Recreate foreign keys with correct table names
            $table->foreign('siswa_id')->references('id')->on('siswa')->nullOnDelete();
            $table->foreign('guru_id')->references('id')->on('guru_bk')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropForeign(['siswa_id']);
            $table->dropForeign(['guru_id']);
        });
    }
};