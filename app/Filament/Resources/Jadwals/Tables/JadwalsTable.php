<?php

namespace App\Filament\Resources\Jadwals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class JadwalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('guru.nama')
                    ->label('Guru')
                    ->sortable(),
                TextColumn::make('hari')
                    ->label('Hari')
                    ->badge(),
                TextColumn::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->time()
                    ->sortable(),
                TextColumn::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->time()
                    ->sortable(),
                TextColumn::make('kuota')
                    ->label('Kuota')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
            ])
            ->filters([
                //
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

