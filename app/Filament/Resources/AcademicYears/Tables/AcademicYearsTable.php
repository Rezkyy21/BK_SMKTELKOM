<?php

namespace App\Filament\Resources\AcademicYears\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class AcademicYearsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Tahun Ajaran')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('start_year')
                    ->label('Mulai')
                    ->sortable(),

                TextColumn::make('end_year')
                    ->label('Selesai')
                    ->sortable(),

                BadgeColumn::make('is_active')
                    ->label('Status')
                    ->colors([
                        'success' => fn ($state) => $state,
                        'danger' => fn ($state) => !$state,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Nonaktif'),
            ])

            ->actions([
                EditAction::make(),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}