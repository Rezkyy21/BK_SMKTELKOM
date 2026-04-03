<?php

namespace App\Filament\Resources\CareerPlans\Pages;

use App\Filament\Resources\CareerPlans\CareerPlanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCareerPlan extends EditRecord
{
    protected static string $resource = CareerPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
