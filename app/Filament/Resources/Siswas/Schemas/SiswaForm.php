<?php

namespace App\Filament\Resources\Siswas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use App\Models\ClassRoom;
use App\Models\Major;

class SiswaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    TextInput::make('nis')
                        ->label('NIS')
                        ->required()
                        ->unique(ignoreRecord: true),

                    TextInput::make('nama')
                        ->label('Nama Lengkap')
                        ->required(),
                ]),

                Grid::make(2)->schema([
                    Select::make('major_id')
                        ->label('Jurusan')
                        ->options(Major::pluck('name', 'id'))
                        ->required()
                        ->reactive()
                        ->afterStateUpdated(fn ($state, callable $set) => $set('class_id', null)),

                    Select::make('class_id')
                        ->label('Kelas')
                        ->options(fn ($get) =>
                            ClassRoom::when($get('major_id'), fn ($query, $majorId) =>
                                $query->where('major_id', $majorId)
                            )
                            ->pluck('name', 'id')
                        )
                        ->searchable()
                        ->reactive()
                        ->required(),
                ]),

                Grid::make(2)->schema([
                    Select::make('jenis_kelamin')
                        ->label('Jenis Kelamin')
                        ->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])
                        ->required(),

                    Select::make('status_akun')
                        ->label('Status Akun')
                        ->options(['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif'])
                        ->default('aktif'),
                ]),
            ]);
    }
}