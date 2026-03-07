<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Siswa;

$siswa = Siswa::where('nis', '541231069')->first();
if ($siswa) {
    echo "✓ Siswa Found: " . $siswa->nama . "\n";
    echo "  NIS: " . $siswa->nis . "\n";
    echo "  Email: " . $siswa->user->email . "\n";
    echo "  Password Check: " . (password_verify('12345678', $siswa->user->password) ? "VALID ✓" : "INVALID") . "\n";
} else {
    echo "✗ Siswa not found\n";
}
