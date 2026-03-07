<?php

// test_siswa.php - Quick test file
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Siswa;
use App\Models\User;

echo "=== Checking Siswa Data ===\n\n";

$siswas = Siswa::with('user')->get();
echo "Total Siswa: " . $siswas->count() . "\n\n";

foreach ($siswas as $siswa) {
    echo "NIS: {$siswa->nis}\n";
    echo "Nama: {$siswa->nama}\n";
    echo "User ID: {$siswa->user_id}\n";
    if ($siswa->user) {
        echo "Email: {$siswa->user->email}\n";
        echo "Role: {$siswa->user->role}\n";
        echo "Status: {$siswa->user->status_akun}\n";
        echo "Password Hash: " . substr($siswa->user->password, 0, 20) . "...\n";
        
        // Test password
        $testPass = password_verify('siswa123', $siswa->user->password);
        echo "Test Password (siswa123): " . ($testPass ? 'VALID ✓' : 'INVALID ✗') . "\n";
    } else {
        echo "ERROR: No user associated!\n";
    }
    echo "---\n";
}
