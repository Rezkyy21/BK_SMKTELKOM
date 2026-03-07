<?php

namespace App\Filament\Resources\Siswas\Pages;

use App\Filament\Resources\Siswas\SiswaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSiswa extends CreateRecord
{
    protected static string $resource = SiswaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // If email provided, create user and attach
        if (!empty($data['email'])) {
            $user = \App\Models\User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['nama_lengkap'] ?? ($data['nama'] ?? 'Siswa'),
                    'password' => bcrypt('siswa123'),
                    'role' => 'siswa',
                    'status_akun' => $data['status_akun'] ?? 'aktif',
                ]
            );

            $data['user_id'] = $user->id;
        }

        // move nama_lengkap to nama if needed
        if (!empty($data['nama_lengkap']) && empty($data['nama'])) {
            $data['nama'] = $data['nama_lengkap'];
        }

        return $data;
    }
}
