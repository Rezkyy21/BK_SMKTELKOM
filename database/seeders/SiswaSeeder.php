<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data siswa untuk testing
        $siswasData = [
            [
                'nis' => '12001',
                'nama' => 'Ahmad Rizki Pratama',
                'kelas' => 'XII RPL 1',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Merdeka No. 123, Purwokerto',
            ],
            [
                'nis' => '12002',
                'nama' => 'Siti Nurhaliza',
                'kelas' => 'XII RPL 1',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Ahmad Yani No. 45, Purwokerto',
            ],
            [
                'nis' => '12003',
                'nama' => 'Budi Santoso',
                'kelas' => 'XII RPL 2',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Sudirman No. 67, Purwokerto',
            ],
            [
                'nis' => '12004',
                'nama' => 'Eka Putri Wijaya',
                'kelas' => 'XII RPL 2',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Gatot Subroto No. 89, Purwokerto',
            ],
            [
                'nis' => '12005',
                'nama' => 'Rendi Gunawan',
                'kelas' => 'XII TKJ 1',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Diponegoro No. 101, Purwokerto',
            ],
            [
                'nis' => '12006',
                'nama' => 'Nisa Amalina',
                'kelas' => 'XII TKJ 1',
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Hayam Wuruk No. 112, Purwokerto',
            ],
        ];

        foreach ($siswasData as $data) {
            // Create user first
            $user = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $data['nama'])) . '@student.smktelkom-pwt.sch.id'],
                [
                    'name' => $data['nama'],
                    'password' => Hash::make('siswa123'), // Default password
                    'role' => 'siswa',
                    'status_akun' => 'aktif',
                ]
            );

            // Create siswa record
            Siswa::firstOrCreate(
                ['nis' => $data['nis']],
                [
                    'user_id' => $user->id,
                    'nama' => $data['nama'],
                    'kelas' => $data['kelas'],
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'alamat' => $data['alamat'],
                    'is_password_changed' => false, // Force to fill profile on first login
                ]
            );
        }

        $this->command->info('Siswa seeder executed successfully!');
        $this->command->info('Test login dengan NIS: 12001, Password: siswa123');
    }
}
