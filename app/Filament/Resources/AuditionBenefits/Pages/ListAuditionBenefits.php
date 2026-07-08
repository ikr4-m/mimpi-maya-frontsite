<?php

namespace App\Filament\Resources\AuditionBenefits\Pages;

use App\Filament\Resources\AuditionBenefits\AuditionBenefitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuditionBenefits extends ListRecords
{
    protected static string $resource = AuditionBenefitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
