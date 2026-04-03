<?php

namespace App\Filament\Resources\GuruBks\Pages;

use App\Filament\Resources\GuruBks\GuruBkResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateGuruBk extends CreateRecord
{
    protected static string $resource = GuruBkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $email = $this->form->getState()['email'] ?? null;
    $password = $this->form->getState()['password'] ?? null;

    if (User::where('email', $email)->exists()) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'data.email' => 'Email sudah digunakan.',
        ]);
    }

    $user = User::create([
        'name' => $data['nama'],
        'email' => $email,
        'password' => Hash::make($password),
        'role' => 'guru_bk',
    ]);

    $data['user_id'] = $user->id;
    unset($data['email'], $data['password']);

    return $data;
}
}