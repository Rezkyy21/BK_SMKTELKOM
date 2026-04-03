<?php

namespace App\Filament\Resources\Jadwals\Pages;

use App\Filament\Resources\Jadwals\JadwalResource;
use App\Filament\Resources\Jadwals\Schemas\JadwalForm;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Schemas\Schema;

class EditJadwal extends EditRecord
{
    protected static string $resource = JadwalResource::class;

    public function form(Schema $schema): Schema
    {
        return JadwalForm::configureForEdit($schema);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Keep guru_id unchanged - prevent editing guru
        $data['guru_id'] = $this->record->guru_id;
        
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
