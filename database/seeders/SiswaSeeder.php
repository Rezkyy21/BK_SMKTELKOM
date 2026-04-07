<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Major;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $rplMajor = Major::where('name', 'RPL')->first();
        $tkjMajor = Major::where('name', 'TKJ')->first();

        if (!$rplMajor || !$tkjMajor) {
            $this->command->warn('Majors RPL/TKJ not found. Skipping SiswaSeeder.');
            return;
        }

        $academicYear = AcademicYear::where('is_active', true)->first();
        if (!$academicYear) {
            $this->command->warn('No active academic year found. Skipping SiswaSeeder.');
            return;
        }

        // Use existing classes created by ClassSeeder
        $classRPL1 = ClassRoom::where('major_id', $rplMajor->id)
            ->where('academic_year_id', $academicYear->id)
            ->where('grade_level', 12)
            ->first();

        $classRPL2 = ClassRoom::where('major_id', $rplMajor->id)
            ->where('academic_year_id', $academicYear->id)
            ->where('grade_level', 11)
            ->first();

        $classTKJ1 = ClassRoom::where('major_id', $tkjMajor->id)
            ->where('academic_year_id', $academicYear->id)
            ->where('grade_level', 12)
            ->first();

        if (!$classRPL1 || !$classRPL2 || !$classTKJ1) {
            $this->command->warn('Required classes not found. Skipping SiswaSeeder.');
            return;
        }

        $siswasData = [
            [
                'nis' => '12001',
                'nama' => 'Ahmad Rizki Pratama',
                'major' => $rplMajor,
                'class' => $classRPL1,
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Merdeka No. 123, Purwokerto',
            ],
            [
                'nis' => '12002',
                'nama' => 'Siti Nurhaliza',
                'major' => $rplMajor,
                'class' => $classRPL1,
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Ahmad Yani No. 45, Purwokerto',
            ],
            [
                'nis' => '12003',
                'nama' => 'Budi Santoso',
                'major' => $rplMajor,
                'class' => $classRPL2,
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Sudirman No. 67, Purwokerto',
            ],
            [
                'nis' => '12004',
                'nama' => 'Eka Putri Wijaya',
                'major' => $rplMajor,
                'class' => $classRPL2,
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Gatot Subroto No. 89, Purwokerto',
            ],
            [
                'nis' => '12005',
                'nama' => 'Rendi Gunawan',
                'major' => $tkjMajor,
                'class' => $classTKJ1,
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. Diponegoro No. 101, Purwokerto',
            ],
            [
                'nis' => '12006',
                'nama' => 'Nisa Amalina',
                'major' => $tkjMajor,
                'class' => $classTKJ1,
                'jenis_kelamin' => 'P',
                'alamat' => 'Jl. Hayam Wuruk No. 112, Purwokerto',
            ],
        ];

        foreach ($siswasData as $data) {
            $user = User::firstOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $data['nama'])) . '@student.smktelkom-pwt.sch.id'],
                [
                    'name' => $data['nama'],
                    'password' => Hash::make('siswa123'),
                    'role' => 'siswa',
                    'status_akun' => 'aktif',
                ]
            );

            Siswa::firstOrCreate(
                ['nis' => $data['nis']],
                [
                    'user_id' => $user->id,
                    'nama' => $data['nama'],
                    'major_id' => $data['major']->id,
                    'class_id' => $data['class']->id,
                    'academic_year_id' => $academicYear->id,
                    'jenis_kelamin' => $data['jenis_kelamin'],
                    'alamat' => $data['alamat'],
                    'is_password_changed' => false,
                ]
            );
        }

        $this->command->info('Siswa seeder executed successfully!');
        $this->command->info('Test login dengan NIS: 12001, Password: siswa123');
    }
}
