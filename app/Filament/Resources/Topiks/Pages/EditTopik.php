<?php

namespace App\Filament\Resources\Topiks\Pages;

use App\Filament\Resources\Topiks\TopikResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTopik extends EditRecord
{
    protected static string $resource = TopikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
