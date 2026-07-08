<?php

namespace App\Filament\Resources\AuditionSettings\Pages;

use App\Filament\Resources\AuditionSettings\AuditionSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditAuditionSetting extends EditRecord
{
    protected static string $resource = AuditionSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
