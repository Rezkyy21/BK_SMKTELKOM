<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$s = App\Models\Siswa::whereHas('user', function($q){
    $q->where('email', '541231069@student.smktelkom-pwt.sch.id');
})->first();

if (! $s) {
    echo "No siswa found\n";
    exit;
}

echo 'siswa->academic_year_id=' . ($s->academic_year_id ?? 'null') . PHP_EOL;
echo 'academic_year_name=' . ($s->academicYear?->name ?? 'none') . PHP_EOL;
echo 'siswa->major_id=' . ($s->major_id ?? 'null') . PHP_EOL;
echo 'siswa->class_id=' . ($s->class_id ?? 'null') . PHP_EOL;
echo 'user->tahun_masuk=' . ($s->user?->tahun_masuk ?? 'none') . PHP_EOL;
