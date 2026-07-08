<?php

namespace App\Filament\Resources\AuditionRequirements\Pages;

use App\Filament\Resources\AuditionRequirements\AuditionRequirementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAuditionRequirement extends EditRecord
{
    protected static string $resource = AuditionRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
