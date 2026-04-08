<?php

require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ClassRoom;

echo "=== SEMUA DATA CLASSROOM ===\n";

$classes = ClassRoom::with('major')->get();

foreach($classes as $class) {
    echo "{$class->id}: {$class->full_name} (grade: {$class->grade_level}, major: {$class->major->name}, name: '{$class->name}')\n";
}

echo "\n=== GROUP BY GRADE ===\n";
$grades = [10, 11, 12];
foreach($grades as $grade) {
    $count = ClassRoom::where('grade_level', $grade)->count();
    echo "Grade $grade: $count classes\n";
}