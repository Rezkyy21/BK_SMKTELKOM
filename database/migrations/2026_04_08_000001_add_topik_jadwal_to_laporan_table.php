<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->string('topik')->nullable()->after('jenis_kelamin');
            $table->string('jadwal')->nullable()->after('topik');
        });

        DB::statement(
            "UPDATE laporan l
            LEFT JOIN booking b ON b.id = l.booking_id
            LEFT JOIN topik t ON t.id = b.topik_id
            LEFT JOIN jadwal j ON j.id = b.jadwal_id
            SET l.topik = t.nama_topik,
                l.jadwal = CASE
                    WHEN j.id IS NULL THEN NULL
                    ELSE CONCAT(j.hari, ' | ', LEFT(j.jam_mulai, 5), ' - ', LEFT(j.jam_selesai, 5))
                END
            WHERE l.booking_id IS NOT NULL"
        );
    }

    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropColumn(['topik', 'jadwal']);
        });
    }
};
