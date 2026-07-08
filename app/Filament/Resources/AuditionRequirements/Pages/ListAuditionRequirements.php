<?php

namespace App\Filament\Resources\AuditionRequirements\Pages;

use App\Filament\Resources\AuditionRequirements\AuditionRequirementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuditionRequirements extends ListRecords
{
    protected static string $resource = AuditionRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
