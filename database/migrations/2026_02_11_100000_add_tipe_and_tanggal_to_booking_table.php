<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->enum('tipe_konseling', ['individu', 'kelompok'])->default('individu')->after('topik_id');
            $table->date('tanggal')->nullable()->after('jadwal_id');
        });
    }

    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn(['tipe_konseling', 'tanggal']);
        });
    }
};
