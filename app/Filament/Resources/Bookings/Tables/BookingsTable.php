<?php

namespace App\Filament\Resources\Bookings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;


class BookingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->modifyQueryUsing(fn (Builder $query) => 
            $query->with(['siswa.kelas.major'])
                ->whereDoesntHave('laporan')
        )
            ->modifyQueryUsing(fn (Builder $query) => $query->whereDoesntHave('laporan'))
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('siswa.nama')
                    ->label('Siswa'),
                    TextColumn::make('siswa.kelas')
                    ->label('Kelas')
                    ->formatStateUsing(function ($record) {
                        $kelas = $record->siswa?->kelas;

                        if (!$kelas) return '-';

                        return 
                            ($kelas->grade_level ?? '-') . ' ' .
                            ($kelas->major->name ?? '-') . ' ' .
                            ($kelas->name ?? '-');
                    }),
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('jadwal.hari')
                    ->label('Hari'),
                TextColumn::make('jadwal.jam_mulai')
                    ->label('Jam')
                    ->formatStateUsing(fn ($record) => $record->jadwal ? substr($record->jadwal->jam_mulai, 0, 5) . ' - ' . substr($record->jadwal->jam_selesai, 0, 5) : '-'),
                TextColumn::make('tipe_konseling')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'kelompok' ? 'Kelompok' : 'Individu'),
                TextColumn::make('topik.nama_topik')
                    ->label('Topik'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),
            ])
            ->filters([
                
            SelectFilter::make('status')
    ->options([
        'pending' => 'Pending',
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
    ])
            ])
            ->recordActions([
                Action::make('detail')
                    ->label('Detail')
                    ->icon('heroicon-m-eye')
                    ->visible(fn ($record) => $record->status === 'menunggu')
                    ->modalWidth('lg')
                    ->modalHeading('Detail Booking')
                   ->modalContent(fn ($record) => view('filament.bookings.detail-modal', [
                            'booking' => $record->load(['siswa.kelas.major','jadwal','topik'])
                        ]))
                    ->modalActions([
                        Action::make('approve')
                            ->label('Setujui Konseling')
                            ->color('success')
                            ->action(fn ($record) => $record->update(['status' => 'disetujui']))
                            ->visible(fn ($record) => $record->status === 'menunggu'),
                        Action::make('reject')
                            ->label('Tolak Konseling')
                            ->color('danger')
                            ->form([
                                \Filament\Forms\Components\Textarea::make('alasan_penolakan')
                                    ->label('Alasan Penolakan')
                                    ->required()
                                    ->maxLength(500),
                            ])
                            ->action(fn ($record, array $data) => $record->update([
                                'status' => 'ditolak',
                                'catatan_siswa' => $data['alasan_penolakan'],
                            ]))
                            ->visible(fn ($record) => $record->status === 'menunggu'),
                    ]),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
            
    }
}

