<?php

namespace App\Filament\Resources\AuditionBenefits\Pages;

use App\Filament\Resources\AuditionBenefits\AuditionBenefitResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAuditionBenefit extends EditRecord
{
    protected static string $resource = AuditionBenefitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
