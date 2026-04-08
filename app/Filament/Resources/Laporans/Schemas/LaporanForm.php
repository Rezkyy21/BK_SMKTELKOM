<?php

namespace App\Filament\Resources\Laporans\Schemas;

use App\Models\Booking;
use App\Models\Siswa;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class LaporanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Section 1: Data Siswa (auto-filled from accepted booking)
                Section::make('Data Siswa')
                    ->schema([
                        Select::make('booking_id')
                            ->label('Booking Siswa (disetujui)')
                            ->options(fn () => Booking::with('siswa.classRoom')
                                ->where('status', 'disetujui')
                                ->doesntHave('laporan')
                                ->get()
                                ->mapWithKeys(fn (Booking $booking) => [$booking->id => $booking->siswa ? $booking->siswa->nama . ' - ' . $booking->tanggal : 'Booking #' . $booking->id])
                                ->toArray())
                            ->searchable()
                            ->required(fn (Get $get) => !$get('id'))
                            ->hidden(fn (Get $get) => (bool) $get('id'))
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set) {
                                $booking = Booking::with(['siswa.classRoom', 'jadwal.guru'])->find($state);
                                if ($booking?->siswa && $booking->status === 'disetujui') {
                                    $set('booking_id', $booking->id);
                                    $set('siswa_id', $booking->siswa_id);
                                    $set('nama_siswa', $booking->siswa->nama);
                                    $set('nis', $booking->siswa->nis);
                                    $set('kelas', $booking->siswa->classRoom?->full_name ?? '-');
                                    $set('jenis_kelamin', $booking->siswa->jenis_kelamin);

                                    if ($booking->jadwal?->guru) {
                                        $set('nama_guru', $booking->jadwal->guru->nama);
                                    }
                                }
                            }),
                        TextInput::make('siswa_id')
                            ->hidden()
                            ->dehydrated(),
                        TextInput::make('nama_siswa')->label('Nama')->readOnly(),
                        TextInput::make('nis')->label('NIS')->readOnly(),
                        TextInput::make('kelas')->label('Kelas')->readOnly(),
                        TextInput::make('jenis_kelamin')->label('Jenis Kelamin')->readOnly(),
                    ])->columns(2),

                // Section 2: Data Sesi
                Section::make('Data Sesi')
                    ->schema([
                        TextInput::make('durasi')
                            ->label('Durasi (menit)')
                            ->numeric()
                            ->required(),
                        Select::make('metode_konseling')
                            ->label('Metode Konseling')
                            ->options(['individu' => 'Individu', 'kelompok' => 'Kelompok'])
                            ->required(),
                        TextInput::make('nama_guru')
                            ->label('Guru BK')
                            ->default(fn() => auth()->user()->guruBk?->nama)
                            ->readOnly(),
                    ])->columns(3),

                // Section 3: Isi Laporan
                Section::make('Isi Laporan')
                    ->schema([
                        Textarea::make('catatan_sesi')
                            ->label('Catatan Jalannya Sesi')
                            ->rows(4)->required()->columnSpanFull(),
                        Textarea::make('diagnosis')
                            ->label('Diagnosis / Penggalian Masalah')
                            ->rows(4)->required()->columnSpanFull(),
                        Textarea::make('tindakan')
                            ->label('Tindakan')
                            ->rows(3)->required()->columnSpanFull(),
                        Textarea::make('kesimpulan')
                            ->label('Kesimpulan')
                            ->rows(3)->required()->columnSpanFull(),
                        Textarea::make('tindak_lanjut')
                            ->label('Tindak Lanjut')
                            ->rows(3)->required()->columnSpanFull(),
                    ]),
            ]);
    }
}

