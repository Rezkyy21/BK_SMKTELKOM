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
            $email = $nis . '@student.smktelkom-pwt.sch.id';

            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name'        => $nama,
                    'password'    => bcrypt($nis), // password default = NIS
                    'role'        => 'siswa',
                    'status_akun' => 'aktif',
                    'major_id'    => $majorId,
                    'class_id'    => $classId,
                ]
            );

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

        if (!preg_match('/^(\d{2})\s+([A-Z]+)[\s\-]+(\d+)$/', $normalized, $m)) {
            return [null, null];
        }

        $grade      = (int) $m[1];
        $majorInput = $m[2];
        $nomor      = (int) $m[3];

        $majorNama = $this->majorAliases[$majorInput] ?? $majorInput;
        $major     = Major::where('name', $majorNama)->first();

        if (!$major) {
            return [null, null];
        }

        // Nama kelas di DB: "11 RPL-1"
        $classNama = $grade . ' ' . $majorNama . '-' . $nomor;
        $class = ClassRoom::where('name', $classNama)
            ->where('grade_level', $grade)
            ->where('major_id', $major->id)
            ->first();

        // Fallback LIKE
        if (!$class) {
            $class = ClassRoom::where('grade_level', $grade)
                ->where('major_id', $major->id)
                ->where('name', 'like', '%' . $majorNama . '-' . $nomor)
                ->first();
        }

        return [$class?->id, $major->id];
    }
}