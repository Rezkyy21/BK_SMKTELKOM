<?php

namespace App\Filament\Resources\KategoriMateris;

use App\Filament\Resources\KategoriMateris\Pages\CreateKategoriMateri;
use App\Filament\Resources\KategoriMateris\Pages\EditKategoriMateri;
use App\Filament\Resources\KategoriMateris\Pages\ListKategoriMateris;
use App\Filament\Resources\KategoriMateris\Schemas\KategoriMateriForm;
use App\Filament\Resources\KategoriMateris\Tables\KategoriMaterisTable;
use App\Models\KategoriMateri;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KategoriMateriResource extends Resource
{
    protected static ?string $model = KategoriMateri::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return KategoriMateriForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriMaterisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKategoriMateris::route('/'),
            'create' => CreateKategoriMateri::route('/create'),
            'edit' => EditKategoriMateri::route('/{record}/edit'),
        ];
    }
}
