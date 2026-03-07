<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class SiswaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $nama = trim($row['nama_lengkap'] ?? '');
            $nis = trim((string) ($row['nis'] ?? ''));
            $email = trim($row['email_sekolah'] ?? $row['email'] ?? '');

            if (empty($nis) || empty($nama)) {
                continue;
            }

            // If siswa exists by nis, update
            $siswa = Siswa::where('nis', $nis)->first();

            if ($siswa) {
                // update name and user email
                $siswa->update(['nama' => $nama]);
                if ($siswa->user && !empty($email)) {
                    $siswa->user->update(['email' => $email, 'name' => $nama]);
                }
                continue;
            }

            // Create or reuse user by email
            $user = null;
            if (!empty($email)) {
                $user = User::where('email', $email)->first();
            }

            if (!$user) {
                $user = User::create([
                    'name' => $nama,
                    'email' => $email ?: Str::slug($nama) . '+' . $nis . '@example.local',
                    'password' => bcrypt('siswa123'),
                    'role' => 'siswa',
                    'status_akun' => 'aktif',
                ]);
            }

            Siswa::create([
                'user_id' => $user->id,
                'nis' => $nis,
                'nama' => $nama,
                'kelas' => '',
                'jenis_kelamin' => 'L',
                'alamat' => null,
                'is_password_changed' => false,
            ]);
        }
    }
}
