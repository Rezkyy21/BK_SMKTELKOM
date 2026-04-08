<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\GuruBk;
use App\Models\Jadwal;

echo "=== DEBUG JADWAL ===\n";

$guru = GuruBk::first();
if ($guru) {
    echo "Guru ID: {$guru->id}, Nama: {$guru->nama}\n";

    $jadwals = Jadwal::where('guru_id', $guru->id)->where('is_active', true)->get();
    echo "Jumlah jadwal aktif: {$jadwals->count()}\n";

    foreach ($jadwals as $jadwal) {
        echo "- ID: {$jadwal->id}, Hari: {$jadwal->hari}, Jam: {$jadwal->jam_mulai}-{$jadwal->jam_selesai}, Kuota: {$jadwal->kuota}\n";
    }
} else {
    echo "Tidak ada guru ditemukan\n";
}

echo "\n=== SEMUA JADWAL ===\n";
$allJadwals = Jadwal::all();
echo "Total jadwal: {$allJadwals->count()}\n";

foreach ($allJadwals as $jadwal) {
    echo "- ID: {$jadwal->id}, Guru: {$jadwal->guru_id}, Hari: {$jadwal->hari}, Active: " . ($jadwal->is_active ? 'Ya' : 'Tidak') . "\n";
}