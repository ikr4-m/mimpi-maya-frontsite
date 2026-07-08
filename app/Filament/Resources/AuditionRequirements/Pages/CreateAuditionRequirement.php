<?php

namespace App\Filament\Resources\AuditionRequirements\Pages;

use App\Filament\Resources\AuditionRequirements\AuditionRequirementResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuditionRequirement extends CreateRecord
{
    protected static string $resource = AuditionRequirementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 'requirement';

        return $data;
    }
}
