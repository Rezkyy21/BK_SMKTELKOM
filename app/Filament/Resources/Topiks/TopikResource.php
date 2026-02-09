<?php

namespace App\Filament\Resources\Topiks;

use App\Filament\Resources\Topiks\Pages\CreateTopik;
use App\Filament\Resources\Topiks\Pages\EditTopik;
use App\Filament\Resources\Topiks\Pages\ListTopiks;
use App\Filament\Resources\Topiks\Schemas\TopikForm;
use App\Filament\Resources\Topiks\Tables\TopiksTable;
use App\Models\Topik;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TopikResource extends Resource
{
    protected static ?string $model = Topik::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TopikForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TopiksTable::configure($table);
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
            'index' => ListTopiks::route('/'),
            'create' => CreateTopik::route('/create'),
            'edit' => EditTopik::route('/{record}/edit'),
        ];
    }
}
