<?php

namespace App\Filament\Resources\AuditionBenefits\Pages;

use App\Filament\Resources\AuditionBenefits\AuditionBenefitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuditionBenefit extends CreateRecord
{
    protected static string $resource = AuditionBenefitResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 'benefit';

        return $data;
    }
}
