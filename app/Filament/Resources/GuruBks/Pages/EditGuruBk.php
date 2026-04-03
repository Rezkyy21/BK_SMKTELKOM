<?php

namespace App\Filament\Resources\GuruBks\Pages;

use App\Filament\Resources\GuruBks\GuruBkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class EditGuruBk extends EditRecord
{
    protected static string $resource = GuruBkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    // Load email dari relasi user ke form
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['email'] = $this->record->user?->email;
        return $data;
    }

    // Update user saat guru BK diedit
   protected function mutateFormDataBeforeSave(array $data): array
{
    $user = $this->record->user;
    
    $email = $this->form->getState()['email'] ?? $user?->email;
    $password = $this->form->getState()['password'] ?? null;

    if ($user) {
        if (User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'data.email' => 'Email sudah digunakan.',
            ]);
        }

        $user->name = $data['nama'];
        $user->email = $email;

        if (!empty($password)) {
            $user->password = Hash::make($password);
        }

        $user->save();
    }

    unset($data['email'], $data['password']);

    return $data;
}
}