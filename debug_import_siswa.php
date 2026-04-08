<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ClassRoom;
use App\Models\Major;
use App\Models\AcademicYear;
use App\Imports\SiswaImport;

echo "=== DEBUG IMPORT SISWA ===\n\n";

echo "1. CEK ACADEMIC YEAR AKTIF:\n";
$ay = AcademicYear::where('is_active', true)->first();
echo "   Academic Year: " . ($ay ? $ay->name : 'TIDAK ADA') . "\n\n";

echo "2. CEK MAJOR YANG ADA:\n";
$majors = Major::all();
foreach($majors as $major) {
    echo "   - {$major->name} (ID: {$major->id})\n";
}
echo "\n";

echo "3. CEK CLASSROOM YANG ADA (LIMIT 5):\n";
$classes = ClassRoom::with('major')->limit(5)->get();
foreach($classes as $class) {
    echo "   - {$class->full_name} (ID: {$class->id}, name: '{$class->name}', grade: {$class->grade_level}, major_id: {$class->major_id})\n";
}
echo "\n";

echo "4. TEST RESOLVE KELAS:\n";
$import = new SiswaImport();
$reflection = new ReflectionClass($import);
$method = $reflection->getMethod('resolveKelas');
$method->setAccessible(true);

// Test berbagai format
$testCases = [
    'XI PPLG 1',
    'X TKJ 2',
    'XII TJA 1',
    'XI RPL 3',
    'X RPL 1',
    'XII TKJ 2'
];

foreach($testCases as $testCase) {
    $result = $method->invoke($import, $testCase);
    $classId = $result[0] ?? 'NULL';
    $majorId = $result[1] ?? 'NULL';

    $status = ($classId !== 'NULL') ? '✅ DITEMUKAN' : '❌ TIDAK DITEMUKAN';

    echo "   Input: '$testCase' -> class_id: $classId, major_id: $majorId [$status]\n";

    if ($classId !== 'NULL') {
        $class = ClassRoom::find($classId);
        echo "      └─ Detail: {$class->full_name} (grade: {$class->grade_level}, major: {$class->major->name})\n";
    }
}

echo "\n5. CONTOH MANUAL QUERY:\n";
// Contoh query manual untuk debugging
$manualClass = ClassRoom::where('grade_level', 11)
    ->where('major_id', 1) // RPL
    ->where('name', '1')
    ->first();

if ($manualClass) {
    echo "   Manual query XI RPL 1: ✅ DITEMUKAN - {$manualClass->full_name}\n";
} else {
    echo "   Manual query XI RPL 1: ❌ TIDAK DITEMUKAN\n";
}

echo "\n=== SELESAI DEBUG ===\n";