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
            if (!Schema::hasColumn('laporan', 'siswa_id')) {
                $table->foreignId('siswa_id')->nullable()->constrained('siswa')->nullOnDelete();
            }
            if (!Schema::hasColumn('laporan', 'nama_siswa')) {
                $table->string('nama_siswa')->nullable();
            }
            if (!Schema::hasColumn('laporan', 'nis')) {
                $table->string('nis')->nullable();
            }
            if (!Schema::hasColumn('laporan', 'kelas')) {
                $table->string('kelas')->nullable();
            }
            if (!Schema::hasColumn('laporan', 'jenis_kelamin')) {
                $table->string('jenis_kelamin')->nullable();
            }
            if (!Schema::hasColumn('laporan', 'nama_guru')) {
                $table->string('nama_guru')->nullable();
            }
            if (!Schema::hasColumn('laporan', 'durasi')) {
                $table->integer('durasi')->nullable();
            }
            if (!Schema::hasColumn('laporan', 'diagnosis')) {
                $table->text('diagnosis')->nullable();
            }
            if (!Schema::hasColumn('laporan', 'tindakan')) {
                $table->text('tindakan')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            if (Schema::hasColumn('laporan', 'siswa_id')) {
                $table->dropForeign(['siswa_id']);
                $table->dropColumn('siswa_id');
            }
            foreach (['nama_siswa', 'nis', 'kelas', 'jenis_kelamin', 'nama_guru', 'durasi', 'diagnosis', 'tindakan'] as $column) {
                if (Schema::hasColumn('laporan', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
