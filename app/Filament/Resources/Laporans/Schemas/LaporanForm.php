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

        // 🔹 HEADER (INFO UTAMA)
        Grid::make(3)
            ->schema([
                Select::make('guru_id')
                    ->relationship('guru', 'nama')
                    ->label('Guru BK')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('booking_id')
                    ->relationship(
                        name: 'booking',
                        titleAttribute: 'id',
                        modifyQueryUsing: function ($query, $livewire) {
                            $query->whereDoesntHave('laporan')
                                ->where('status', 'accepted');

                            if ($livewire instanceof \Filament\Resources\Pages\EditRecord) {
                                $record = $livewire->record;

                                if ($record?->booking_id) {
                                    $query->orWhere('id', $record->booking_id);
                                }
                            }
                        }
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn ($record) => "{$record->siswa->nama} - {$record->topik->nama_topik}"
                    )
                    ->label('Jadwal Konseling')
                    ->searchable()
                    ->required(),

                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'submitted' => 'Submitted',
                        'approved' => 'Approved',
                    ])
                    ->default('draft')
                    ->required(),
            ]),

        // 🔹 DETAIL SESI
        Grid::make(2)
            ->schema([
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

        // 🔹 ISI LAPORAN (FULL WIDTH BIAR NYAMAN NULIS)
        Textarea::make('catatan_sesi')
            ->label('Catatan Jalannya Sesi')
            ->rows(4)
            ->columnSpanFull()
            ->required(),

        Textarea::make('assessment')
            ->label('Assessment / Diagnosis')
            ->rows(4)
            ->columnSpanFull()
            ->required(),

        Textarea::make('kesimpulan')
            ->label('Kesimpulan')
            ->rows(3)
            ->columnSpanFull()
            ->required(),

        Textarea::make('rekomendasi')
            ->label('Rekomendasi')
            ->rows(3)
            ->columnSpanFull()
            ->required(),

        Textarea::make('tindak_lanjut')
            ->label('Tindak Lanjut')
            ->rows(3)
            ->columnSpanFull()
            ->required(),
    ]);
    }
}

