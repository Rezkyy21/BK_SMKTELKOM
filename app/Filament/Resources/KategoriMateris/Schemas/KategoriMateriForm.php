<?php

namespace App\Filament\Resources\KategoriMateris\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class KategoriMateriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_kategori')
                    ->required()
                    ->label('Nama Kategori'),

                TextInput::make('slug')
                    ->label('Slug')
                    ->helperText('Biarkan kosong untuk auto-generate jika Anda handle di model'),
            ]);
    }
}
