<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Tahun Ajaran')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('Contoh: 2025/2026'),

               TextInput::make('start_year')
                ->label('Tahun Mulai')
                ->numeric()
                ->required()
                ->live()
                ->afterStateUpdated(function ($set, $get) {
                    $start = $get('start_year');
                    $end = $get('end_year');

                    if ($start && $end) {
                        $set('name', $start . '/' . $end);
                    }
                }),
                    

               TextInput::make('end_year')
                ->label('Tahun Selesai')
                ->numeric()
                ->required()
                ->live()
                ->afterStateUpdated(function ($set, $get) {
                    $start = $get('start_year');
                    $end = $get('end_year');

                    if ($start && $end) {
                        $set('name', $start . '/' . $end);
                    }
                }),

                Toggle::make('is_active')
                    ->label('Aktifkan Tahun Ini')
                    ->default(false),
            ]);
    }
}