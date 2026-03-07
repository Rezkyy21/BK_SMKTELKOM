<?php

namespace App\Filament\Resources\Laporans\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LaporanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('guru_id')
                    ->default(auth()->user()?->guruBk?->id ?? null),
                
                Grid::make(2)
                    ->schema([
                        Select::make('booking_id')
                            ->relationship('booking', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->siswa->nama} - {$record->topik->nama_topik}")
                            ->required()
                            ->label('Jadwal Konseling'),
                        
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'submitted' => 'Submitted (Menunggu Verifikasi)',
                                'approved' => 'Approved (Sudah Diverifikasi)',
                            ])
                            ->default('draft')
                            ->required()
                            ->helperText('Ubah ke "Submitted" ketika laporan siap untuk diverifikasi'),
                        
                        TextInput::make('durasi_sesi')
                            ->numeric()
                            ->default(30)
                            ->suffix('menit')
                            ->label('Durasi Sesi'),
                        
                        Select::make('metode_konseling')
                            ->options([
                                'individual' => 'Individual',
                                'group' => 'Group',
                                'class' => 'Class',
                            ])
                            ->label('Metode Konseling'),
                    ]),
                
                Textarea::make('catatan_sesi')
                    ->label('Catatan Jalannya Sesi')
                    ->rows(4)
                    ->placeholder('Deskripsikan jalannya sesi konseling...')
                    ->required(),
                
                Textarea::make('assessment')
                    ->label('Assessment / Diagnosis')
                    ->rows(4)
                    ->placeholder('Penilaian kondisi siswa...')
                    ->required(),
                
                Textarea::make('kesimpulan')
                    ->label('Kesimpulan')
                    ->rows(3)
                    ->placeholder('Kesimpulan hasil konseling...')
                    ->required(),
                
                Textarea::make('rekomendasi')
                    ->label('Rekomendasi')
                    ->rows(3)
                    ->placeholder('Rekomendasi dan saran...')
                    ->required(),
                
                Textarea::make('tindak_lanjut')
                    ->label('Tindak Lanjut')
                    ->rows(3)
                    ->placeholder('Rencana follow-up atau tindak lanjut...')
                    ->required(),
            ]);
    }
}

