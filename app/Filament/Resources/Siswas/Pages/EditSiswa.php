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
            $currentUser = $this->record->user;

            if ($currentUser) {
                $duplicate = \App\Models\User::where('email', $data['email'])
                    ->where('id', '!=', $currentUser->id)
                    ->first();

                if ($duplicate) {
                    throw new \Exception('Alamat email sudah digunakan oleh akun lain.');
                }

                $currentUser->update([
                    'email' => $data['email'],
                    'name' => $data['nama_lengkap'] ?? $data['nama'] ?? $currentUser->name,
                ]);

                $data['user_id'] = $currentUser->id;
            } else {
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
        }

        if (!empty($data['nama_lengkap']) && empty($data['nama'])) {
            $data['nama'] = $data['nama_lengkap'];
        }

        return $data;
    }
}
