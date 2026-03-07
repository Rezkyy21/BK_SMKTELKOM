<?php

namespace App\Filament\Resources\Siswas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;

class SiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    TextInput::make('nis')
                        ->label('NIS')
                        ->required(),

                    TextInput::make('nama_lengkap')
                        ->label('Nama Lengkap')
                        ->required(),
                ]),

                Grid::make(2)->schema([
                    TextInput::make('email')
                        ->label('Email Sekolah')
                        ->email()
                        ->required(),

                    Select::make('status_akun')
                        ->label('Status Akun')
                        ->options(['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif'])
                        ->default('aktif'),
                ]),
            ]);
    }
}
