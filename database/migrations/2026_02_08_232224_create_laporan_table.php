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
            $table->foreignId('booking_id')->unique()->constrained('booking')->cascadeOnDelete();
            $table->foreignId('guru_id')->constrained('guru_bk')->cascadeOnDelete();
            $table->text('kesimpulan');
            $table->text('rekomendasi');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};