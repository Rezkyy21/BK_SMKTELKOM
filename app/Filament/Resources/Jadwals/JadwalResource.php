<?php

namespace App\Filament\Resources\Jadwals;

use App\Filament\Resources\Jadwals\Pages\CreateJadwal;
use App\Filament\Resources\Jadwals\Pages\EditJadwal;
use App\Filament\Resources\Jadwals\Pages\ListJadwals;
use App\Filament\Resources\Jadwals\Schemas\JadwalForm;
use App\Filament\Resources\Jadwals\Tables\JadwalsTable;
use App\Models\Jadwal;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class JadwalResource extends Resource
{
    protected static ?string $model = Jadwal::class;
    protected static ?string $navigationLabel = 'Jadwal';
protected static ?string $pluralLabel = 'Jadwal';
protected static ?string $modelLabel = 'Jadwal';
protected static string|UnitEnum|null $navigationGroup = 'Konseling';

   protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clock';

    public static function form(Schema $schema): Schema
    {
        return JadwalForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalsTable::configure($table);
    }

    /**
     * Scope the base query so that non‑admins only see their own jadwals.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // if a guru is logged in, limit to their records
        if (auth()->check() && auth()->user()->guruBk) {
            $query->where('guru_id', auth()->user()->guruBk->id);
        }

        return $query;
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
            'index' => ListJadwals::route('/'),
            'create' => CreateJadwal::route('/create'),
            'edit' => EditJadwal::route('/{record}/edit'),
        ];
    }
}
