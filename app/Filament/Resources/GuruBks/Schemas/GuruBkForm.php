<?php

namespace App\Filament\Resources\GuruBks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GuruBkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'email')
                    ->required()
                    ->label('User (Email)'),
                TextInput::make('nip')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('NIP'),
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Guru'),
                Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'cuti' => 'Cuti',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->default('aktif')
                    ->required()
                    ->label('Status'),
            ]);
    }
}

