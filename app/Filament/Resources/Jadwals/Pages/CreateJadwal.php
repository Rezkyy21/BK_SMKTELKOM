<?php

namespace App\Filament\Resources\Jadwals\Pages;

use App\Filament\Resources\Jadwals\JadwalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJadwal extends CreateRecord
{
    protected static string $resource = JadwalResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Auto-fill guru_id dengan guru dari akun yang login
        if (!$data['guru_id'] && auth()->user()?->guruBk) {
            $data['guru_id'] = auth()->user()->guruBk->id;
        }

        return $data;
    }
}
