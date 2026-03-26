<?php

namespace App\Filament\Resources\ClassRooms;

use App\Filament\Resources\ClassRooms\Pages\CreateClassRoom;
use App\Filament\Resources\ClassRooms\Pages\EditClassRoom;
use App\Filament\Resources\ClassRooms\Pages\ListClassRooms;
use App\Filament\Resources\ClassRooms\Schemas\ClassRoomForm;
use App\Filament\Resources\ClassRooms\Tables\ClassRoomsTable;
use App\Models\ClassRoom;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Major;
use UnitEnum;
class ClassRoomResource extends Resource
{
        protected static ?string $navigationLabel = 'Kelas';
        protected static ?string $pluralLabel = 'Kelas';
        protected static ?string $modelLabel = 'Kelas';
        protected static string|UnitEnum|null $navigationGroup = 'Data';
    protected static ?string $model = ClassRoom::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $recordTitleAttribute = 'full_name';

    public static function form(Schema $schema): Schema
    {
        return ClassRoomForm::configure($schema);
    }
 public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }
    public static function table(Table $table): Table
    {
        return ClassRoomsTable::configure($table);
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
            'index' => ListClassRooms::route('/'),
            'create' => CreateClassRoom::route('/create'),
            'edit' => EditClassRoom::route('/{record}/edit'),
        ];
    }
}
