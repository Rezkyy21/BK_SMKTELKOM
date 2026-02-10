<?php

namespace Database\Seeders;

use App\Models\GuruBk;
use App\Models\Jadwal;
use App\Models\Siswa;
use App\Models\Topik;
use App\Models\User;
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
            $user = User::updateOrCreate([
                'email' => $email,
            ], [
                'name' => 'Siswa ' . $i,
                'password' => bcrypt('siswa123'),
                'role' => 'siswa',
            ]);

            Siswa::updateOrCreate([
                'user_id' => $user->id,
            ], [
                'nis' => '202400' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama' => 'Siswa ' . $i,
                'kelas' => 'X-' . chr(65 + ($i % 3)),
                'jenis_kelamin' => $i % 2 == 0 ? 'P' : 'L',
                'alamat' => 'Jl. Test ' . $i,
            ]);
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

