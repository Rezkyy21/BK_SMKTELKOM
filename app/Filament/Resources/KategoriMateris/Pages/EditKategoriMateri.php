<?php

namespace App\Filament\Resources\KategoriMateris\Pages;

use App\Filament\Resources\KategoriMateris\KategoriMateriResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriMateri extends EditRecord
{
    protected static string $resource = KategoriMateriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
