<?php

namespace App\Filament\Resources\Laporans;

use App\Filament\Resources\Laporans\Pages\CreateLaporan;
use App\Filament\Resources\Laporans\Pages\EditLaporan;
use App\Filament\Resources\Laporans\Pages\ListLaporans;
use App\Filament\Resources\Laporans\Schemas\LaporanForm;
use App\Filament\Resources\Laporans\Pages;
use App\Filament\Resources\Laporans\Tables\LaporansTable;
use App\Models\Laporan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;
    protected static ?string $navigationLabel = 'Laporan';
protected static ?string $pluralLabel = 'Laporan';
protected static ?string $modelLabel = 'Laporan';
protected static string|UnitEnum|null $navigationGroup = 'Konseling';

    public static function canViewAny(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'guru_bk', 'guru']);
    }

    public static function canCreate(): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'guru_bk', 'guru']);
    }

    public static function canEdit($record): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'guru_bk', 'guru']);
    }

    public static function canDelete($record): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'guru_bk', 'guru']);
    }

    public static function canView($record): bool
    {
        return auth()->check() && in_array(auth()->user()->role, ['admin', 'guru_bk', 'guru']);
    }

    public static function form(Schema $schema): Schema
    {
        return LaporanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporansTable::configure($table);
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
        'index' => Pages\ListLaporans::route('/'),
        'create' => Pages\CreateLaporan::route('/create'),
        'edit' => Pages\EditLaporan::route('/{record}/edit'),

        // 🔥 TAMBAH INI
        'view' => Pages\ViewLaporan::route('/{record}'),
    ];
}
}
