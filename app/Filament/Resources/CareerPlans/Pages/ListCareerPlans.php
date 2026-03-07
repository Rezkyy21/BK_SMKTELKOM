<?php

namespace App\Filament\Resources\CareerPlans\Pages;

use App\Filament\Resources\CareerPlans\CareerPlanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCareerPlans extends ListRecords
{
    protected static string $resource = CareerPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
