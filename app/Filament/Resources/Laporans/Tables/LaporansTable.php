<?php

namespace App\Filament\Resources\Laporans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
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
                TextColumn::make('booking.siswa.nama')
                    ->label('Nama Siswa')
                    ->searchable(),
                
                TextColumn::make('booking.topik.nama')
                    ->label('Topik Konseling')
                    ->searchable(),
                
                TextColumn::make('durasi_sesi')
                    ->label('Durasi (menit)')
                    ->suffix(' menit'),
                
                BadgeColumn::make('metode_konseling')
                    ->label('Metode')
                    ->colors([
                        'primary' => 'individual',
                        'success' => 'group',
                        'info' => 'class',
                    ]),
                
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'draft',
                        'info' => 'submitted',
                        'success' => 'approved',
                    ]),
                
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d-m-Y H:i'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'submitted' => 'Submitted',
                        'approved' => 'Approved',
                    ]),
                
                SelectFilter::make('metode_konseling')
                    ->options([
                        'individual' => 'Individual',
                        'group' => 'Group',
                        'class' => 'Class',
                    ]),
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
