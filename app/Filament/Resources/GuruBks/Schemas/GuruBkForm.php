<?php

namespace App\Filament\Resources\GuruBks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Illuminate\Validation\Rules\Unique;

class GuruBkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                TextInput::make('nama')
                    ->required()
                    ->label('Nama Guru'),
                TextInput::make('nip')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->label('NIP'),
                FileUpload::make('photo')
                ->label('Foto Guru')
                ->image()
                ->disk('public')       // WAJIB
                ->directory('guru-bk')
                ->visibility('public')
                ->nullable(),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(
                        table: 'users',
                        column: 'email',
                        ignoreRecord: true,
                    )
                    ->label('Email')
                    ->visibleOn('create'),
               TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn ($operation) => $operation === 'create'),
                Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'cuti' => 'Cuti',
                        'nonaktif' => 'Nonaktif',
                    ])
                    ->default('aktif')
                    ->required()
                    ->label('Status'),
                TextInput::make('no_whatsapp')
                    ->label('Nomor WhatsApp')
                    ->placeholder('628123456789')
                    ->helperText('Format: 628xxx tanpa + atau spasi')
                    ->nullable(),
            ]);
    }
}