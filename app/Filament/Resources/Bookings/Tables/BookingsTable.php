<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('siswa.nama')
                    ->label('Siswa'),
                TextColumn::make('jadwal.hari')
                    ->label('Hari'),
                TextColumn::make('topik.nama_topik')
                    ->label('Topik'),
                TextColumn::make('mode_konseling')
                    ->label('Mode'),
                TextColumn::make('status')
                    ->label('Status'),
            ])
            ->filters([
                //
            ])
            
->recordActions([
    Action::make('approve')
        ->label('Setujui')
        ->icon('heroicon-m-check-circle')
        ->color('success')
        ->visible(fn ($record) => $record->status === 'menunggu')
        ->action(fn ($record) => $record->update(['status' => 'disetujui']))
        ->successNotificationTitle('Konseling disetujui'),
    
    Action::make('reject')
        ->label('Tolak')
        ->icon('heroicon-m-x-circle')
        ->color('danger')
        ->visible(fn ($record) => $record->status === 'menunggu')
        ->form([
            \Filament\Forms\Components\Textarea::make('alasan_penolakan')
                ->label('Alasan Penolakan')
                ->required()
                ->maxLength(500),
        ])
        ->action(function ($record, array $data) {
            $record->update([
                'status' => 'ditolak',
                'catatan_siswa' => $data['alasan_penolakan'],
            ]);
        })
        ->successNotificationTitle('Konseling ditolak'),
    
    EditAction::make(),
])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

