<?php

namespace App\Filament\Resources\KategoriMateris\Pages;

use App\Filament\Resources\KategoriMateris\KategoriMateriResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriMateris extends ListRecords
{
    protected static string $resource = KategoriMateriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
