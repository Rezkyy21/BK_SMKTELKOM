<?php

namespace App\Filament\Resources\Jadwals\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class JadwalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('guru_id')
                    ->relationship('guru', 'nama')
                    ->required()
                    ->label('Guru BK'),
                Select::make('hari')
                    ->options([
                        'senin' => 'Senin',
                        'selasa' => 'Selasa',
                        'rabu' => 'Rabu',
                        'kamis' => 'Kamis',
                        'jumat' => 'Jumat',
                        'sabtu' => 'Sabtu',
                    ])
                    ->required(),
                TimePicker::make('jam_mulai')
                    ->required()
                    ->label('Jam Mulai'),
                TimePicker::make('jam_selesai')
                    ->required()
                    ->label('Jam Selesai'),
                TextInput::make('kuota')
                    ->required()
                    ->numeric()
                    ->default(5)
                    ->label('Kuota'),
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Aktif'),
            ]);
    }
}

