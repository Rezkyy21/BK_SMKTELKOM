<?php

use Illuminate\Support\Facades\Route;
use App\Models\Siswa;
use App\Models\User;

Route::get('/debug/siswa', function () {
    $siswas = Siswa::with('user')->get();
    
    foreach ($siswas as $siswa) {
        echo "=== Siswa ===\n";
        echo "NIS: " . $siswa->nis . "\n";
        echo "Nama: " . $siswa->nama . "\n";
        echo "User ID: " . $siswa->user_id . "\n";
        echo "User Email: " . ($siswa->user?->email ?? 'NULL') . "\n";
        echo "User Password Hash: " . substr($siswa->user?->password ?? 'NULL', 0, 20) . "...\n";
        echo "is_password_changed: " . ($siswa->is_password_changed ? 'true' : 'false') . "\n";
        echo "\n";
    }
    
    echo "\n=== Test Password Verify ===\n";
    $siswa = Siswa::where('nis', '20240001')->first();
    if ($siswa && $siswa->user) {
        $testPassword = 'siswa123';
        $isValid = password_verify($testPassword, $siswa->user->password);
        echo "NIS: " . $siswa->nis . "\n";
        echo "Test Password: " . $testPassword . "\n";
        echo "Password Valid: " . ($isValid ? 'YES' : 'NO') . "\n";
    }
});
