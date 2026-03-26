<?php

namespace App\Filament\Resources\ClassRooms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ClassRoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kelas')
                    ->placeholder('Contoh: 1, 2, 3')
                    ->required(),

                Select::make('grade_level')
                    ->label('Tingkat')
                    ->options([
                        10 => 'X',
                        11 => 'XI',
                        12 => 'XII',
                    ])
                    ->required(),

               Select::make('major_id')
                    ->label('Jurusan')
                    ->relationship('major', 'name')
                    ->required(),
            ]);
    }
}