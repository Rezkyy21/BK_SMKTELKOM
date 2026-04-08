<?php

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ClassRoom;
use App\Models\Major;
use App\Imports\SiswaImport;

echo "=== DEBUG PARSE KELAS ===\n\n";

// Test parsing berbagai format
$testInputs = [
    'XI PPLG 1',
    'X TKJ 2',
    'XII TJA 1',
    'XI RPL 3',
    'X RPL 1',
    'XII TKJ 2',
    'XI PPLG 1',  // duplikat untuk test
];

$import = new SiswaImport();
$reflection = new ReflectionClass($import);
$method = $reflection->getMethod('resolveKelas');
$method->setAccessible(true);

foreach ($testInputs as $input) {
    echo "Testing: '{$input}'\n";

    // Manual parsing untuk debug
    $normalized = strtoupper(trim($input));
    $normalized = str_replace(['XII', 'XI', 'X'], ['12', '11', '10'], $normalized);
    echo "  Normalized: '{$normalized}'\n";

    if (preg_match('/^(\d{2})\s+([A-Z]+)[\s\-]+(\d+)$/', $normalized, $m)) {
        $grade = (int) $m[1];
        $majorInput = $m[2];
        $nomor = (int) $m[3];

        echo "  Parsed: grade={$grade}, majorInput={$majorInput}, nomor={$nomor}\n";

        // Check major mapping
        $majorAliases = [
            'PPLG' => 'RPL',
            'RPL'  => 'RPL',
            'TKJ'  => 'TKJ',
            'TJA'  => 'TJA',
        ];

        $majorNama = $majorAliases[$majorInput] ?? $majorInput;
        echo "  Major mapped: {$majorInput} -> {$majorNama}\n";

        $major = Major::where('name', $majorNama)->first();
        if ($major) {
            echo "  Major found: {$major->name} (ID: {$major->id})\n";

            // Test query
            $class1 = ClassRoom::where('grade_level', $grade)
                ->where('major_id', $major->id)
                ->where('name', (string)$nomor)
                ->first();

            if ($class1) {
                echo "  ✅ Class found (Method 1): {$class1->full_name}\n";
            } else {
                echo "  ❌ Class NOT found (Method 1)\n";

                // Check wrong format
                $wrongFormat = $grade . ' ' . $majorNama . '-' . $nomor;
                $class2 = ClassRoom::where('grade_level', $grade)
                    ->where('major_id', $major->id)
                    ->where('name', $wrongFormat)
                    ->first();

                if ($class2) {
                    echo "  ✅ Class found (Method 2 - wrong format): {$class2->full_name}\n";
                } else {
                    echo "  ❌ Class NOT found (Method 2)\n";
                }
            }
        } else {
            echo "  ❌ Major NOT found: {$majorNama}\n";
        }
    } else {
        echo "  ❌ Regex failed\n";
    }

    // Test actual method
    $result = $method->invoke($import, $input);
    $classId = $result[0] ?? 'NULL';
    $majorId = $result[1] ?? 'NULL';
    echo "  Method result: class_id={$classId}, major_id={$majorId}\n";

    echo "\n";
}

echo "=== CHECK DATABASE CONTENT ===\n";

// Check sample data
$sampleClasses = ClassRoom::with('major')->limit(10)->get();
foreach ($sampleClasses as $class) {
    echo "ID {$class->id}: grade={$class->grade_level}, major={$class->major->name}, name='{$class->name}', full_name='{$class->full_name}'\n";
}