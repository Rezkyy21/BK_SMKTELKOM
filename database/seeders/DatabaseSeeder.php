<?php

namespace Database\Seeders;

use App\Models\GuruBk;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\Topik;
use App\Models\User;
use App\Models\Major;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use Database\Seeders\KategoriMateriSeeder;
use Database\Seeders\ClassSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =========================
        // 1. Academic Years
        // =========================
        $academicYears = [];
        $yearsData = [
            ['name' => '2023/2024', 'start_year' => 2023, 'end_year' => 2024, 'is_active' => false],
            ['name' => '2024/2025', 'start_year' => 2024, 'end_year' => 2025, 'is_active' => false],
            ['name' => '2025/2026', 'start_year' => 2025, 'end_year' => 2026, 'is_active' => true],
            ['name' => '2026/2027', 'start_year' => 2026, 'end_year' => 2027, 'is_active' => false],
        ];

        foreach ($yearsData as $yearData) {
            $academicYears[$yearData['name']] = AcademicYear::updateOrCreate(
                ['name' => $yearData['name']],
                $yearData
            );
        }

        // Ensure only one active year
        $activeYearName = '2025/2026';
        AcademicYear::query()->where('name', '!=', $activeYearName)->update(['is_active' => false]);
        $activeYear = $academicYears[$activeYearName];

        // =========================
        // 2. Majors (Jurusan)
        // =========================
        $majors = [];
        foreach (['RPL', 'TKJ', 'TJA'] as $majorName) {
            $majors[$majorName] = Major::firstOrCreate(['name' => $majorName], ['name' => $majorName]);
        }

        // =========================
        // 3. Classes (ClassRoom)
        // =========================
        $this->call(ClassSeeder::class);

        // =========================
        // 4. Admin User
        // =========================
        User::updateOrCreate(
            ['email' => 'admin@smktelkom-pwt.sch.id'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ]
        );

        // =========================
        // 5. Guru BK Users
        // =========================
        for ($i = 1; $i <= 3; $i++) {
            $email = 'guru' . $i . '@smktelkom-pwt.sch.id';
            $user = User::updateOrCreate(['email' => $email], [
                'name' => 'Guru BK ' . $i,
                'password' => bcrypt('guru123'),
                'role' => 'guru_bk',
            ]);

            GuruBk::updateOrCreate(['user_id' => $user->id], [
                'nip' => '20010001000' . $i,
                'nama' => 'Guru BK ' . $i,
                'status' => 'aktif',
            ]);
        }

        // =========================
        // 6. Siswa Users
        // =========================
        for ($i = 1; $i <= 5; $i++) {
            $email = 'siswa' . $i . '@smktelkom-pwt.sch.id';

            $major = Major::inRandomOrder()->first();
            $classRoom = ClassRoom::where('major_id', $major->id)
                ->where('academic_year_id', $activeYear->id)
                ->first();

            $user = User::updateOrCreate(['email' => $email], [
                'name' => 'Siswa ' . $i,
                'password' => bcrypt('siswa123'),
                'role' => 'siswa',
                'status_akun' => 'aktif',
            ]);

            Siswa::updateOrCreate(['user_id' => $user->id], [
                'nis' => '202400' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama' => $user->name,
                'major_id' => $major->id,
                'class_id' => $classRoom->id,
                'academic_year_id' => $activeYear->id,
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'alamat' => 'Jl. Test ' . $i,
                'is_password_changed' => false,
            ]);
        }

        // =========================
        // 7. Real Test Siswa
        // =========================
        $realMajor = Major::firstWhere('name', 'RPL');
        if (! $realMajor) {
            $realMajor = Major::firstOrCreate(['name' => 'RPL']);
        }

       $realClassRoom = ClassRoom::where('major_id', $realMajor->id)
    ->where('grade_level', 12)
    ->where('name', '12 RPL-3')
    ->first();

if (! $realClassRoom) {
    $realClassRoom = ClassRoom::where('major_id', $realMajor->id)
        ->where('grade_level', 12)
        ->first();
}

if (! $realClassRoom) {
    $realClassRoom = ClassRoom::first();
}

        $realUser = User::updateOrCreate(['email' => '541231069@student.smktelkom-pwt.sch.id'], [
            'name' => 'Farrezki Maulana Putra',
            'password' => bcrypt('12345678'),
            'role' => 'siswa',
            'status_akun' => 'aktif',
            'major_id' => $realMajor->id,
            'class_id' => $realClassRoom->id,
            'tahun_masuk' => 2024,
        ]);

        Siswa::updateOrCreate(['user_id' => $realUser->id], [
            'nis' => '541231069',
            'nama' => $realUser->name,
            'major_id' => $realMajor->id,
            'class_id' => $realClassRoom->id,
            'academic_year_id' => $activeYear->id,
            'jenis_kelamin' => 'L',
            'alamat' => 'Purwokerto',
            'is_password_changed' => false,
        ]);

        // =========================
        // 8. Ensure All Siswa Have Record
        // =========================
        $allSiswaUsers = User::where('role', 'siswa')->get();
        foreach ($allSiswaUsers as $u) {
            if (!$u->siswa) {
                $className = null;
                if ($u->class_id) {
                    $class = ClassRoom::find($u->class_id);
                    $className = $class?->name;
                }
                $nis = '2024' . str_pad($u->id, 6, '0', STR_PAD_LEFT);

                Siswa::create([
                    'user_id' => $u->id,
                    'nis' => $nis,
                    'nama' => $u->name,
                    'kelas' => $className ?? 'X-A',
                    'jenis_kelamin' => 'L',
                    'alamat' => null,
                    'is_password_changed' => false,
                ]);
            }
        }

        // =========================
        // 9. Topics
        // =========================
        $topics = [
            'Akademik' => 'Konseling terkait masalah akademik siswa',
            'Karir' => 'Konseling terkait pilihan karir dan profesi',
            'Pribadi' => 'Konseling terkait masalah pribadi dan emosional',
            'Sosial' => 'Konseling terkait hubungan sosial dan pertemanan',
        ];
        foreach ($topics as $name => $desc) {
            Topik::updateOrCreate(['nama_topik' => $name], [
                'deskripsi' => $desc,
                'is_active' => true,
            ]);
        }

        // =========================
        // 10. Jadwal Guru BK
        // =========================
        $guru = GuruBk::first();
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];

        foreach ($days as $day) {
            Jadwal::updateOrCreate([
                'guru_id' => $guru->id,
                'hari' => $day,
            ], [
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '11:00:00',
                'kuota' => 5,
                'is_active' => true,
            ]);
        }

        // =========================
        // 11. Kategori Materi Seeder
        // =========================
        $this->call(KategoriMateriSeeder::class);

        // =========================
        // 12. Siswa Seeder (additional test students)
        // =========================
        $this->call(SiswaSeeder::class);
    }
}