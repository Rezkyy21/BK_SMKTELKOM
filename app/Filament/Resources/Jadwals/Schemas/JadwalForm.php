<?php

namespace App\Filament\Resources\Jadwals\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class JadwalForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('guru_id')
                    ->relationship('guru', 'nama')
                    ->required()
                    ->default(fn () => auth()->user()?->guruBk?->id)
                    ->disabled(fn () => auth()->user()?->guruBk ? true : false)
                    ->dehydrated()
                    ->label('Nama Guru (Dari Akun Anda)'),
                
                Select::make('hari')
                    ->options([
                        'senin' => 'Senin',
                        'selasa' => 'Selasa',
                        'rabu' => 'Rabu',
                        'kamis' => 'Kamis',
                        'jumat' => 'Jumat',
                        'sabtu' => 'Sabtu',
                    ])
                    ->required()
                    ->native(false),
                
                TimePicker::make('jam_mulai')
                    ->format('H:i')
                    ->required()
                    ->label('Jam Mulai')
                    ->helperText('Format: HH:mm (contoh: 08:30)'),
                
                TimePicker::make('jam_selesai')
                    ->format('H:i')
                    ->required()
                    ->label('Jam Selesai')
                    ->helperText('Format: HH:mm (contoh: 09:30)'),
                
                TextInput::make('kuota')
                    ->required()
                    ->numeric()
                    ->default(5)
                    ->minValue(1)
                    ->maxValue(50)
                    ->label('Kuota Konseling')
                    ->helperText('Jumlah siswa yang dapat melakukan konseling'),
                
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Aktif'),
            ]);
    }

    public static function configureForEdit(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('guru_id')
                    ->relationship('guru', 'nama')
                    ->required()
                    ->disabled()
                    ->dehydrated()
                    ->label('Nama Guru (Dari Akun Anda)'),
                
                Select::make('hari')
                    ->options([
                        'senin' => 'Senin',
                        'selasa' => 'Selasa',
                        'rabu' => 'Rabu',
                        'kamis' => 'Kamis',
                        'jumat' => 'Jumat',
                        'sabtu' => 'Sabtu',
                    ])
                    ->required()
                    ->native(false),
                
                TimePicker::make('jam_mulai')
                    ->format('H:i')
                    ->required()
                    ->label('Jam Mulai')
                    ->helperText('Format: HH:mm (contoh: 08:30)'),
                
                TimePicker::make('jam_selesai')
                    ->format('H:i')
                    ->required()
                    ->label('Jam Selesai')
                    ->helperText('Format: HH:mm (contoh: 09:30)'),
                
                TextInput::make('kuota')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(50)
                    ->label('Kuota Konseling')
                    ->helperText('Jumlah siswa yang dapat melakukan konseling'),
                
                Toggle::make('is_active')
                    ->default(true)
                    ->label('Aktif'),
            ]);
    }
}




