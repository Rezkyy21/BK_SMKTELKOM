<?php

namespace App\Filament\Resources\Topiks\Pages;

use App\Filament\Resources\Topiks\TopikResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTopiks extends ListRecords
{
    protected static string $resource = TopikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
