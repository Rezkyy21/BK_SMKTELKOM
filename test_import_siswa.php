<?php

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Siswa;
use App\Models\User;
use App\Models\ClassRoom;
use App\Imports\SiswaImport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

// Test data yang mirip dengan Excel
$testData = [
    ['nis' => '123456', 'nama_lengkap' => 'Test Siswa 1', 'jenis_kelamin' => 'L', 'kelas' => 'XI PPLG 1'],
    ['nis' => '123457', 'nama_lengkap' => 'Test Siswa 2', 'jenis_kelamin' => 'P', 'kelas' => 'X TKJ 2'],
    ['nis' => '123458', 'nama_lengkap' => 'Test Siswa 3', 'jenis_kelamin' => 'L', 'kelas' => 'XII TJA 1'],
];

echo "=== TEST IMPORT SISWA ===\n\n";

// Test resolveKelas untuk setiap data
$import = new SiswaImport();
$reflection = new ReflectionClass($import);
$method = $reflection->getMethod('resolveKelas');
$method->setAccessible(true);

foreach ($testData as $row) {
    $namaKelas = $row['kelas'];
    $result = $method->invoke($import, $namaKelas);
    $classId = $result[0];
    $majorId = $result[1];

    echo "Kelas: '{$namaKelas}' -> class_id: " . ($classId ?? 'NULL') . ", major_id: " . ($majorId ?? 'NULL') . "\n";

    if ($classId) {
        $class = ClassRoom::find($classId);
        echo "  └─ Ditemukan: {$class->full_name} (ID: {$class->id})\n";
    } else {
        echo "  └─ ❌ TIDAK DITEMUKAN\n";
    }
}

echo "\n=== CEK DATA SISWA YANG SUDAH ADA ===\n";

// Cek apakah siswa test sudah ada dan punya class_id
foreach ($testData as $row) {
    $siswa = Siswa::where('nis', $row['nis'])->first();
    if ($siswa) {
        echo "NIS {$row['nis']}: class_id = " . ($siswa->class_id ?? 'NULL');
        if ($siswa->class_id) {
            $class = ClassRoom::find($siswa->class_id);
            echo " ({$class->full_name})";
        }
        echo "\n";
    }
}

echo "\n=== CEK LOG TERBARU ===\n";
echo "Cek file storage/logs/laravel.log untuk log debug import\n";