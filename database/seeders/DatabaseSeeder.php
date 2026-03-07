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
        // Create academic years
        $academicYears = [];
        $yearsData = [
            ['name' => '2024/2025', 'start_year' => 2024, 'end_year' => 2025, 'is_active' => false],
            ['name' => '2025/2026', 'start_year' => 2025, 'end_year' => 2026, 'is_active' => true],
            ['name' => '2026/2027', 'start_year' => 2026, 'end_year' => 2027, 'is_active' => false],
        ];
        foreach ($yearsData as $yearData) {
            $academicYears[$yearData['name']] = AcademicYear::firstOrCreate(
                ['name' => $yearData['name']],
                $yearData
            );
        }
        // Ensure only one year is active -- activate 2025/2026 explicitly
        $activeYearName = '2025/2026';
        if (isset($academicYears[$activeYearName])) {
            $academicYears[$activeYearName]->activate();
        }

        // Create majors (jurusan)
        $majors = [];
        foreach (['RPL', 'TKJ', 'TJA'] as $majorName) {
            $majors[$majorName] = Major::firstOrCreate(
                ['name' => $majorName],
                ['name' => $majorName]
            );
        }

        // Create classes for each major and grade level (10, 11, 12)
        // Each grade has 8 classes (1, 2, 3, 4, 5, 6, 7, 8)
        // Use the seeded active year (2025/2026)
        $activeYear = $academicYears[$activeYearName];
        foreach ($majors as $majorName => $major) {
            for ($grade = 10; $grade <= 12; $grade++) {
                for ($i = 1; $i <= 8; $i++) {
                    ClassRoom::firstOrCreate(
                        [
                            'major_id' => $major->id,
                            'grade_level' => $grade,
                            'name' => "{$grade}-{$i}",
                            'academic_year_id' => $activeYear->id,
                        ]
                    );
                }
            }
        }

        // Create or update admin user
        $admin = User::updateOrCreate([
            'email' => 'admin@smktelkom-pwt.sch.id',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Create guru_bk users and records
        for ($i = 1; $i <= 3; $i++) {
            $email = 'guru' . $i . '@smktelkom-pwt.sch.id';
            $user = User::updateOrCreate([
                'email' => $email,
            ], [
                'name' => 'Guru BK ' . $i,
                'password' => bcrypt('guru123'),
                'role' => 'guru_bk',
            ]);

            GuruBk::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'nip' => '20010001000' . $i,
                'nama' => 'Guru BK ' . $i,
                'status' => 'aktif',
            ]);
        }

        // Create siswa users and records
        for ($i = 1; $i <= 5; $i++) {
            $email = 'siswa' . $i . '@smktelkom-pwt.sch.id';
            
            // Get a random major
            $major = Major::inRandomOrder()->first();
            
            // Get active academic year
            $activeYear = AcademicYear::where('is_active', true)->first();
            
            // Get a class for that major
            $classRoom = ClassRoom::where('major_id', $major?->id)
                ->where('academic_year_id', $activeYear?->id)
                ->first();
            
            $user = User::updateOrCreate([
                'email' => $email,
            ], [
                'name' => 'Siswa ' . $i,
                'password' => bcrypt('siswa123'),
                'role' => 'siswa',
                'status_akun' => 'aktif',
                'major_id' => $major?->id,
                'class_id' => $classRoom?->id,
                'tahun_masuk' => 2024,
            ]);

            Siswa::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'nis' => '202400' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama' => 'Siswa ' . $i,
                'kelas' => $classRoom?->name ?? 'X-A',
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'alamat' => 'Jl. Test ' . $i,
                'is_password_changed' => false, // Force to fill profile on first login
            ]);
        }

        // Create siswa users and records
        for ($i = 1; $i <= 5; $i++) {
            $email = 'siswa' . $i . '@smktelkom-pwt.sch.id';
            
            // Get a random major
            $major = Major::inRandomOrder()->first();
            
            // Get active academic year
            $activeYear = AcademicYear::where('is_active', true)->first();
            
            // Get a class for that major
            $classRoom = ClassRoom::where('major_id', $major?->id)
                ->where('academic_year_id', $activeYear?->id)
                ->first();
            
            $user = User::updateOrCreate([
                'email' => $email,
            ], [
                'name' => 'Siswa ' . $i,
                'password' => bcrypt('siswa123'),
                'role' => 'siswa',
                'status_akun' => 'aktif',
                'major_id' => $major?->id,
                'class_id' => $classRoom?->id,
                'tahun_masuk' => 2024,
            ]);

            Siswa::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'nis' => '202400' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama' => 'Siswa ' . $i,
                'kelas' => $classRoom?->name ?? 'X-A',
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'alamat' => 'Jl. Test ' . $i,
                'is_password_changed' => false, // Force to fill profile on first login
            ]);
        }

        // Create real test siswa
        $realMajor = Major::where('name', 'RPL')->first();
        $activeYear = AcademicYear::where('is_active', true)->first();
        $realClassRoom = ClassRoom::where('major_id', $realMajor?->id)
            ->where('academic_year_id', $activeYear?->id)
            ->where('grade_level', 12)
            ->where('name', '12-3')
            ->first();

        $realUser = User::updateOrCreate([
            'email' => '541231069@student.smktelkom-pwt.sch.id',
        ], [
            'name' => 'Farrezki Maulana Putra',
            'password' => bcrypt('12345678'),
            'role' => 'siswa',
            'status_akun' => 'aktif',
            'major_id' => $realMajor?->id,
            'class_id' => $realClassRoom?->id,
            'tahun_masuk' => 2024,
        ]);

        Siswa::updateOrCreate([
            'user_id' => $realUser->id,
        ], [
            'nis' => '541231069',
            'nama' => 'Farrezki Maulana Putra',
            'kelas' => $realClassRoom?->name ?? '12-3',
            'jenis_kelamin' => 'L',
            'alamat' => 'Purwokerto',
            'is_password_changed' => false, // Force to fill profile on first login
        ]);

        // Ensure every User with role 'siswa' has a corresponding Siswa record
        $allSiswaUsers = User::where('role', 'siswa')->get();
        foreach ($allSiswaUsers as $u) {
            if (!$u->siswa) {
                // Try to infer class name from class_id
                $className = null;
                if ($u->class_id) {
                    $class = ClassRoom::find($u->class_id);
                    $className = $class?->name;
                }

                // Generate a deterministic NIS if missing
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

        // Create topics
        Topik::updateOrCreate(['nama_topik' => 'Akademik'], ['deskripsi' => 'Konseling terkait masalah akademik siswa', 'is_active' => true]);
        Topik::updateOrCreate(['nama_topik' => 'Karir'], ['deskripsi' => 'Konseling terkait pilihan karir dan profesi', 'is_active' => true]);
        Topik::updateOrCreate(['nama_topik' => 'Pribadi'], ['deskripsi' => 'Konseling terkait masalah pribadi dan emosional', 'is_active' => true]);
        Topik::updateOrCreate(['nama_topik' => 'Sosial'], ['deskripsi' => 'Konseling terkait hubungan sosial dan pertemanan', 'is_active' => true]);

        // Create jadwal (schedules)
        $guru = GuruBk::first();
        $days = ['senin', 'selasa', 'rabu', 'kamis', 'jumat'];

        foreach ($days as $index => $day) {
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

        // Seed kategori materi (Belajar, Karir, Pribadi, Sosial)
        $this->call(KategoriMateriSeeder::class);
    }
}

