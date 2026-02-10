<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('jadwal_id')
                    ->relationship('jadwal', 'hari')
                    ->required()
                    ->label('Jadwal'),
                Select::make('siswa_id')
                    ->relationship('siswa', 'nis')
                    ->required()
                    ->label('Siswa'),
                Select::make('topik_id')
                    ->relationship('topik', 'nama_topik')
                    ->required()
                    ->label('Topik'),
                Select::make('mode_konseling')
                    ->options([
                        'online' => 'Online',
                        'offline' => 'Offline',
                    ])
                    ->default('offline')
                    ->label('Mode Konseling'),
                Select::make('mode_identitas')
                    ->options([
                        'asli' => 'Asli',
                        'anonim' => 'Anonim',
                    ])
                    ->default('asli')
                    ->label('Mode Identitas'),
                Select::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                        'selesai' => 'Selesai',
                    ])
                    ->default('menunggu')
                    ->label('Status'),
                Textarea::make('catatan_siswa')
                    ->label('Catatan Siswa'),
            ]);
    }
}
