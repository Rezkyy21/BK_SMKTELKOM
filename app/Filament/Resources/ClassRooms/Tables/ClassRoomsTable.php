<?php

namespace App\Filament\Resources\ClassRooms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Major;
class ClassRoomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
          
               ->columns([
    TextColumn::make('full_name')
        ->label('Kelas')
        ->searchable()
        ->sortable(),

    TextColumn::make('grade_level')
        ->label('Tingkat')
        ->formatStateUsing(fn ($state) => match ($state) {
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
            default => $state,
        })
        ->sortable(),

    TextColumn::make('major.name')
        ->label('Jurusan')
        ->searchable()
        ->sortable(),

    TextColumn::make('name')
        ->label('Nama Kelas'),

        TextColumn::make('guru.nama')
        ->label('Guru BK')
        ->searchable()
        ->sortable(),

       
])
            
            ->filters([
                SelectFilter::make('guru_id')
    ->label('Guru BK')
    ->options(\App\Models\GuruBk::pluck('nama','id'))
    ->searchable(),
               
                   SelectFilter::make('grade_level')
        ->label('Tingkat')
        ->options([
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ]),

    SelectFilter::make('major_id')
        ->label('Jurusan')
        ->options(\App\Models\Major::pluck('name', 'id'))
        ->searchable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
