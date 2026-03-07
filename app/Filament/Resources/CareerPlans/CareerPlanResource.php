<?php

namespace App\Filament\Resources\CareerPlans;

use App\Filament\Resources\CareerPlans\Pages\CreateCareerPlan;
use App\Filament\Resources\CareerPlans\Pages\EditCareerPlan;
use App\Filament\Resources\CareerPlans\Pages\ListCareerPlans;
use App\Filament\Resources\CareerPlans\Pages\ViewCareerPlan;
use App\Filament\Resources\CareerPlans\Schemas\CareerPlanForm;
use App\Filament\Resources\CareerPlans\Tables\CareerPlansTable;
use App\Models\CareerPlan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CareerPlanResource extends Resource
{
    protected static ?string $model = CareerPlan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CareerPlanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CareerPlansTable::configure($table);
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
            'index' => ListCareerPlans::route('/'),
            'create' => CreateCareerPlan::route('/create'),
            'view' => ViewCareerPlan::route('/{record}'),
            'edit' => EditCareerPlan::route('/{record}/edit'),
        ];
    }

    // Only guru_bk users can access career plans
    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->role === 'guru_bk';
    }

    public static function canView(Model $record): bool
    {
        return auth()->check() && auth()->user()->role === 'guru_bk';
    }

    public static function canCreate(): bool
    {
        return auth()->check() && auth()->user()->role === 'guru_bk';
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->check() && auth()->user()->role === 'guru_bk';
    }

    public static function canUpdate(Model $record): bool
    {
        return auth()->check() && auth()->user()->role === 'guru_bk';
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->check() && auth()->user()->role === 'guru_bk';
    }
}
