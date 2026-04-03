<?php

namespace App\Filament\Resources\Laporans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class LaporansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_siswa')->label('Nama Siswa')->searchable(),
                TextColumn::make('nis')->label('NIS')->searchable(),
                TextColumn::make('kelas')->label('Kelas'),
                BadgeColumn::make('metode_konseling')->label('Metode'),
                TextColumn::make('nama_guru')->label('Guru BK'),
                TextColumn::make('created_at')->label('Tanggal')->date('d/m/Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
