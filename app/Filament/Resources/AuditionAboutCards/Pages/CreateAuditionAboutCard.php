<?php

namespace App\Filament\Resources\AuditionAboutCards\Pages;

use App\Filament\Resources\AuditionAboutCards\AuditionAboutCardResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuditionAboutCard extends CreateRecord
{
    protected static string $resource = AuditionAboutCardResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 'about_card';

        return $data;
    }
}
