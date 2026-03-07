<?php

namespace App\Filament\Resources\Materis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use App\Models\KategoriMateri;

class MateriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('kategori_id')
                    ->label('Kategori')
                    ->options(KategoriMateri::all()->pluck('nama_kategori', 'id')->toArray())
                    ->required(),

                TextInput::make('judul')
                    ->required()
                    ->label('Judul'),

                TextInput::make('slug')
                    ->label('Slug')
                    ->helperText('Bisa dikosongkan dan isi akan di-generate otomatis'),

                Textarea::make('konten')
                    ->label('Konten')
                    ->rows(10)
                    ->required(),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                     ->disk('public'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'publish' => 'Publish',
                    ])
                    ->default('draft'),

                DateTimePicker::make('published_at')
                    ->label('Tanggal Publish')
                    ->nullable(),
            ]);
    }
}
