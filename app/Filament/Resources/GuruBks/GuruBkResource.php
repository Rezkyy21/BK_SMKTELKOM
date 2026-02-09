<?php

namespace App\Filament\Resources\GuruBks;

use App\Filament\Resources\GuruBks\Pages\CreateGuruBk;
use App\Filament\Resources\GuruBks\Pages\EditGuruBk;
use App\Filament\Resources\GuruBks\Pages\ListGuruBks;
use App\Filament\Resources\GuruBks\Schemas\GuruBkForm;
use App\Filament\Resources\GuruBks\Tables\GuruBksTable;
use App\Models\GuruBk;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GuruBkResource extends Resource
{
    protected static ?string $model = GuruBk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return GuruBkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GuruBksTable::configure($table);
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
            'index' => ListGuruBks::route('/'),
            'create' => CreateGuruBk::route('/create'),
            'edit' => EditGuruBk::route('/{record}/edit'),
        ];
    }
}
