<?php

namespace App\Filament\Resources\Siswas\Pages;

use App\Filament\Resources\Siswas\SiswaResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSiswa extends EditRecord
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Ensure user exists and update
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

            // update fields
            $user->update(['name' => $data['nama_lengkap'] ?? $data['nama']]);

            $data['user_id'] = $user->id;
        }

        if (!empty($data['nama_lengkap']) && empty($data['nama'])) {
            $data['nama'] = $data['nama_lengkap'];
        }

        return $data;
    }
}
