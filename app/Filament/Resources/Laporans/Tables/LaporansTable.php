<?php

namespace App\Filament\Resources\Laporans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\DateFilter;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Tables\Table;
use App\Models\Siswa;

class LaporansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('guru.nama')
                ->label('Guru BK')
                ->searchable()
                ->sortable(),
               TextColumn::make('booking.siswa.nama')
                    ->label('Nama Siswa')
                    ->searchable(),
            TextColumn::make('booking.siswa.classRoom.full_name')
                ->label('Kelas')
                ->sortable()
                ->placeholder('-'),
               
               TextColumn::make('booking.topik.nama_topik')
                ->label('Topik Konseling')
                ->searchable(),
                 TextColumn::make('booking.jadwal')
                ->label('Jadwal Konseling')
                ->formatStateUsing(function ($state, $record) {
                    $jadwal = $record->booking?->jadwal;

                    if (!$jadwal) return '-';

                    return $jadwal->hari . ' | ' .
                        substr($jadwal->jam_mulai, 0, 5) . ' - ' .
                        substr($jadwal->jam_selesai, 0, 5);
                }),

    TextColumn::make('created_at')
        ->label('Dibuat Pada')
        ->dateTime('d-m-Y H:i'),

    BadgeColumn::make('metode_konseling')
        ->label('Metode')
        ->colors([
            'primary' => 'individual',
            'success' => 'group',
            'info' => 'class',
        ]),

    TextColumn::make('catatan_sesi')
        ->label('Catatan Jalannya Sesi')
        ->limit(25),


    TextColumn::make('kesimpulan')
        ->label('Kesimpulan')
        ->limit(25),

    TextColumn::make('tindak_lanjut')
        ->label('Tindak Lanjut')
        ->limit(25),
])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'submitted' => 'Submitted',
                        'approved' => 'Approved',
                    ]),

                SelectFilter::make('metode_konseling')
                    ->label('Metode Konseling')
                    ->options([
                        'individual' => 'Individual',
                        'group' => 'Group',
                        'class' => 'Class',
                    ]),

                MultiSelectFilter::make('guru_id')
                    ->label('Guru BK')
                    ->relationship('guru', 'nama'),

                MultiSelectFilter::make('booking.siswa_id')
                    ->label('Nama Siswa')
                    ->relationship('booking.siswa', 'nama'),

                MultiSelectFilter::make('booking.topik_id')
                    ->label('Topik Konseling')
                    ->relationship('booking.topik', 'nama_topik'),

               
            ])
            ->recordActions([
               ViewAction::make()
                ->url(fn ($record) => route('filament.admin.resources.laporans.view', $record)),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
