<?php

namespace App\Filament\Resources\GuruBks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class GuruBksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                ->label('Foto')
                ->circular(),
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('nip')
                    ->label('NIP'),
                TextColumn::make('nama')
                    ->label('Nama'),
                TextColumn::make('user.email')
                    ->label('Email'),
                TextColumn::make('status')
                    ->label('Status'),
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

