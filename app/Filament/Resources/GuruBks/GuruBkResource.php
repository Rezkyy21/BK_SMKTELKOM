<?php

namespace App\Filament\Resources\GuruBks;

use App\Filament\Resources\GuruBks\Pages\CreateGuruBk;
use App\Filament\Resources\GuruBks\Pages\EditGuruBk;
use App\Filament\Resources\GuruBks\Pages\ListGuruBks;
use App\Filament\Resources\GuruBks\Schemas\GuruBkForm;
use App\Filament\Resources\GuruBks\Tables\GuruBksTable;
use App\Models\GuruBk;
use Illuminate\Database\Eloquent\Model;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class GuruBkResource extends Resource
{
    protected static ?string $model = GuruBk::class;
    protected static ?string $navigationLabel = 'Guru BK';
    protected static ?string $pluralLabel = 'Guru BK';
    protected static ?string $modelLabel = 'Guru BK';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user';
     protected static string|UnitEnum|null $navigationGroup = 'Data';


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

    // only administrators may interact with this resource
    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public static function canCreate(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
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
