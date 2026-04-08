<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\User;
use App\Models\ClassRoom;
use App\Models\Major;
use App\Models\AcademicYear;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class SiswaImport implements ToCollection, WithHeadingRow
{
    /**
     * Mapping jurusan dari Excel → nama di database.
     * PPLG di Excel → RPL di database (nama lama).
     */
    private array $majorAliases = [
        'PPLG' => 'RPL',
        'RPL'  => 'RPL',
        'TKJ'  => 'TKJ',
        'TJA'  => 'TJA',
    ];

    public function collection(Collection $rows)
    {
        $academicYear = AcademicYear::where('is_active', true)->first();

        foreach ($rows as $row) {
            $nis          = trim((string) ($row->get('nis') ?? ''));
            $nama         = trim($row->get('nama_lengkap') ?? '');
            $jenisKelamin = trim($row->get('jenis_kelamin') ?? '');
            $namaKelas    = trim($row->get('kelas') ?? ''); // "XI PPLG 1"

            // Skip baris kosong
            if (empty($nis) || empty($nama)) {
                continue;
            }

            // Resolve class_id & major_id dari nama kelas
            [$classId, $majorId] = $this->resolveKelas($namaKelas);

            // DEBUG: Log hasil resolveKelas
            \Log::info("IMPORT SISWA DEBUG - NIS: {$nis}, Kelas: '{$namaKelas}' -> class_id: " . ($classId ?? 'NULL') . ", major_id: " . ($majorId ?? 'NULL'));

            // Jika class_id null, log error tapi lanjutkan import
            if (!$classId) {
                \Log::warning("IMPORT SISWA WARNING - Class tidak ditemukan untuk kelas: '{$namaKelas}' (NIS: {$nis})");
            }

            // ── Siswa sudah ada → update kelas saja, TIDAK reset password/email ──
            $existingSiswa = Siswa::where('nis', $nis)->first();

            if ($existingSiswa) {
                $existingSiswa->update([
                    'nama'             => $nama,
                    'jenis_kelamin'    => $jenisKelamin ?: $existingSiswa->jenis_kelamin,
                    'class_id'         => $classId ?? $existingSiswa->class_id,
                    'major_id'         => $majorId ?? $existingSiswa->major_id,
                    'academic_year_id' => $academicYear?->id ?? $existingSiswa->academic_year_id,
                ]);

                // Update nama di tabel users, JANGAN sentuh password & email
                if ($existingSiswa->user) {
                    $existingSiswa->user->update(['name' => $nama]);
                }

                continue;
            }

            // ── Siswa baru → buat akun user + record siswa ──
            $email = trim((string) ($row->get('email') ?? '')) ?: ($nis . '@student.smktelkom-pwt.sch.id');

            $existingUser = User::where('email', $email)->first();
            if ($existingUser) {
                if ($existingUser->role !== 'siswa') {
                    throw new \Exception("Email siswa tidak dapat menggunakan akun yang sudah terdaftar sebagai {$existingUser->role}.");
                }

                if ($existingUser->siswa) {
                    throw new \Exception('Email siswa sudah terhubung dengan akun siswa lain. Periksa data import.');
                }

                $user = $existingUser;
            } else {
                $user = User::create([
                    'name'        => $nama,
                    'email'       => $email,
                    'password'    => bcrypt($nis), // password default = NIS
                    'role'        => 'siswa',
                    'status_akun' => 'aktif',
                    'major_id'    => $majorId,
                    'class_id'    => $classId,
                ]);
            }

            Siswa::create([
                'user_id'             => $user->id,
                'nis'                 => $nis,
                'nama'                => $nama,
                'jenis_kelamin'       => $jenisKelamin,
                'class_id'            => $classId,
                'major_id'            => $majorId,
                'academic_year_id'    => $academicYear?->id,
                'alamat'              => null,
                'is_password_changed' => false,
            ]);
        }
    }

    /**
     * Parse nama kelas "XI PPLG 1" → [class_id, major_id]
     * Format: "XI PPLG 1", "X TKJ 2", "XII TJA 1"
     */
    private function resolveKelas(string $namaKelas): array
    {
        if (empty($namaKelas)) {
            return [null, null];
        }

        $normalized = strtoupper(trim($namaKelas));
        $normalized = str_replace(['XII', 'XI', 'X'], ['12', '11', '10'], $normalized);

        // DEBUG: Log input parsing
        \Log::info("RESOLVE KELAS DEBUG - Input: '{$namaKelas}', Normalized: '{$normalized}'");

        if (!preg_match('/^(\d{2})\s+([A-Z]+)[\s\-]+(\d+)$/', $normalized, $m)) {
            \Log::warning("RESOLVE KELAS DEBUG - Regex failed for: '{$normalized}'");
            return [null, null];
        }

        $grade      = (int) $m[1];
        $majorInput = $m[2];
        $nomor      = (int) $m[3];

        \Log::info("RESOLVE KELAS DEBUG - Parsed: grade={$grade}, majorInput={$majorInput}, nomor={$nomor}");

        $majorNama = $this->majorAliases[$majorInput] ?? $majorInput;
        $major     = Major::where('name', $majorNama)->first();

        if (!$major) {
            \Log::warning("RESOLVE KELAS DEBUG - Major not found: '{$majorNama}'");
            return [null, null];
        }

        \Log::info("RESOLVE KELAS DEBUG - Major found: {$major->name} (ID: {$major->id})");

        // Method 1: Cari berdasarkan format name yang benar (hanya angka)
        $class = ClassRoom::where('grade_level', $grade)
            ->where('major_id', $major->id)
            ->where('name', (string)$nomor)
            ->first();

        if ($class) {
            \Log::info("RESOLVE KELAS DEBUG - Class found (Method 1): {$class->full_name} (ID: {$class->id})");
            return [$class->id, $major->id];
        }

        // Method 2: Fallback - cari berdasarkan format name yang salah (dengan prefix)
        $wrongFormat = $grade . ' ' . $majorNama . '-' . $nomor;
        $class = ClassRoom::where('grade_level', $grade)
            ->where('major_id', $major->id)
            ->where('name', $wrongFormat)
            ->first();

        if ($class) {
            \Log::info("RESOLVE KELAS DEBUG - Class found (Method 2): {$class->full_name} (ID: {$class->id})");
            return [$class->id, $major->id];
        }

        // Method 3: Ultimate fallback - cari berdasarkan full_name comparison
        $gradeRoman = match($grade) {
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
            default => (string)$grade
        };

        $expectedFullName = $gradeRoman . ' ' . $majorNama . ' ' . $nomor;

        $classes = ClassRoom::with('major')
            ->where('grade_level', $grade)
            ->where('major_id', $major->id)
            ->get();

        \Log::info("RESOLVE KELAS DEBUG - Checking {$classes->count()} classes for grade {$grade}, major {$major->id}");

        foreach ($classes as $c) {
            \Log::info("RESOLVE KELAS DEBUG - Comparing: '{$c->full_name}' vs '{$expectedFullName}'");
            if (strtoupper($c->full_name) === strtoupper($expectedFullName)) {
                \Log::info("RESOLVE KELAS DEBUG - Class found (Method 3): {$c->full_name} (ID: {$c->id})");
                return [$c->id, $major->id];
            }
        }

        \Log::warning("RESOLVE KELAS DEBUG - No class found for: grade={$grade}, major={$majorNama}, nomor={$nomor}");
        return [null, null];
    }
}