<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->foreignId('guru_id')->constrained('guru_bk')->cascadeOnDelete();
            $table->foreignId('booking_id')->nullable()->nullOnDelete();

            // Data siswa (snapshot saat laporan dibuat)
            $table->string('nama_siswa');
            $table->string('nis');
            $table->string('kelas');
            $table->string('jenis_kelamin');

            // Data sesi
            $table->integer('durasi')->comment('dalam menit');
            $table->string('metode_konseling'); // individu / kelompok
            $table->string('nama_guru');

            // Isi laporan
            $table->text('catatan_sesi');
            $table->text('diagnosis');
            $table->text('tindakan');
            $table->text('kesimpulan');
            $table->text('tindak_lanjut');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};