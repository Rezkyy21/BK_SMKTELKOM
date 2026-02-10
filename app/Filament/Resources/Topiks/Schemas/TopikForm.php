<?php

namespace App\Filament\Resources\Topiks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TopikForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_topik')
                    ->required()
                    ->label('Nama Topik'),
                Textarea::make('deskripsi')
                    ->label('Deskripsi'),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Aktif'),
            ]);
    }
}
