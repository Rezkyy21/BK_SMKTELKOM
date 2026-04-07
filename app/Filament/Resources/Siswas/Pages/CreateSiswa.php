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
            $user = \App\Models\User::where('email', $data['email'])->first();

            if ($user) {
                if ($user->role !== 'siswa') {
                    throw new \Exception('Alamat email sudah digunakan oleh akun yang bukan siswa.');
                }

                if ($user->siswa) {
                    throw new \Exception('Alamat email sudah terhubung dengan siswa lain.');
                }
            } else {
                $user = \App\Models\User::create([
                    'name' => $data['nama_lengkap'] ?? ($data['nama'] ?? 'Siswa'),
                    'email' => $data['email'],
                    'password' => bcrypt('siswa123'),
                    'role' => 'siswa',
                    'status_akun' => $data['status_akun'] ?? 'aktif',
                ]);
            }

            $data['user_id'] = $user->id;
        }

        // move nama_lengkap to nama if needed
        if (!empty($data['nama_lengkap']) && empty($data['nama'])) {
            $data['nama'] = $data['nama_lengkap'];
        }

        return $data;
    }
}
