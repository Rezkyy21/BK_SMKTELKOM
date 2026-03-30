<?php

namespace App\Filament\Resources\Laporans\Pages;

use App\Filament\Resources\Laporans\LaporanResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Actions\Action;

class ViewLaporan extends ViewRecord
{
    protected static string $resource = LaporanResource::class;

public function infolist(Schema $schema): Schema
{
    return $schema
        ->components([

            // 🔹 DATA SISWA - DIATAS
            Section::make('Data Siswa')
                ->schema([
                    TextEntry::make('nama_siswa')
                        ->label('Nama Siswa'),

                    TextEntry::make('kelas')
                        ->label('Kelas'),

                    TextEntry::make('guru.nama')
                        ->label('Guru BK'),

                    TextEntry::make('topik')
                        ->label('Topik Konseling'),

                    TextEntry::make('jadwal')
                        ->label('Jadwal Konseling')
                        ->formatStateUsing(function ($state, $record) {
                            $jadwal = $record->booking?->jadwal;

                            if (!$jadwal) return '-';

                            return $jadwal->hari . ' | ' .
                                substr($jadwal->jam_mulai, 0, 5) . ' - ' .
                                substr($jadwal->jam_selesai, 0, 5);
                        }),
                ]),

            // 🔹 DETAIL KONSELING - DI BAWAH DATA SISWA
            Section::make('Detail Konseling')
                ->schema([
                    TextEntry::make('metode_konseling')
                        ->label('Metode')
                        ->badge(),

                    TextEntry::make('durasi_sesi')
                        ->label('Durasi')
                        ->suffix(' menit'),

                    TextEntry::make('status')
                        ->label('Status')
                        ->badge(),

                    TextEntry::make('created_at')
                        ->label('Dibuat')
                        ->dateTime('d-m-Y H:i'),

                    TextEntry::make('updated_at')
                        ->label('Update')
                        ->dateTime('d-m-Y H:i'),
                ]),

            // 🔹 ISI LAPORAN - DI BAWAH DETAIL
            Section::make('Isi Laporan')
                ->schema([
                    TextEntry::make('catatan_sesi')
                        ->label('Catatan Sesi')
                        ->columnSpanFull(),

                    TextEntry::make('assessment')
                        ->label('Assessment')
                        ->columnSpanFull(),

                    TextEntry::make('kesimpulan')
                        ->label('Kesimpulan')
                        ->columnSpanFull(),
                ]),

            // 🔹 TINDAK LANJUT - DI BAWAH ISI LAPORAN
            Section::make('Tindak Lanjut')
                ->schema([
                    TextEntry::make('rekomendasi')
                        ->label('Rekomendasi')
                        ->columnSpanFull(),

                    TextEntry::make('tindak_lanjut')
                        ->label('Tindak Lanjut')
                        ->columnSpanFull(),
                ]),
        ]);
}


    protected function getHeaderActions(): array
{
    return [
        Action::make('back')
            ->label('Kembali')
            ->url($this->getResource()::getUrl('index'))
            ->color('gray'),
    ];
}
}