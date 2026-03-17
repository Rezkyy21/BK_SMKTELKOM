<?php

namespace App\Filament\Resources\Topiks;

use App\Filament\Resources\Topiks\Pages\CreateTopik;
use App\Filament\Resources\Topiks\Pages\EditTopik;
use App\Filament\Resources\Topiks\Pages\ListTopiks;
use App\Filament\Resources\Topiks\Schemas\TopikForm;
use App\Filament\Resources\Topiks\Tables\TopiksTable;
use App\Models\Topik;
use Illuminate\Database\Eloquent\Model;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
class TopikResource extends Resource
{
    protected static ?string $model = Topik::class;

    protected static ?string $navigationLabel = 'Topik';
protected static ?string $pluralLabel = 'Topik';
protected static ?string $modelLabel = 'Topik';
protected static string|UnitEnum|null $navigationGroup = 'Kategori';
protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';

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

    // only administrators may manage topiks
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
            'index' => ListTopiks::route('/'),
            'create' => CreateTopik::route('/create'),
            'edit' => EditTopik::route('/{record}/edit'),
        ];
    }
}
