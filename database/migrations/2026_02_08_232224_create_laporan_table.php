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
            $table->foreignId('booking_id')->constrained('booking')->cascadeOnDelete();
            $table->foreignId('guru_id')->constrained('guru_bk')->cascadeOnDelete();
            
            // Laporan details
            $table->text('catatan_sesi')->nullable()->comment('Catatan jalannya sesi konseling');
            $table->text('assessment')->nullable()->comment('Penilaian/diagnosis');
            $table->text('kesimpulan')->nullable();
            $table->text('rekomendasi')->nullable();
            $table->string('tindak_lanjut')->nullable()->comment('Follow-up atau tindak lanjut');
            $table->integer('durasi_sesi')->default(30)->comment('Durasi dalam menit');
            $table->string('metode_konseling')->nullable()->comment('Metode yang digunakan: individual, group, etc');
            $table->enum('status', ['draft', 'submitted', 'approved'])->default('draft');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};