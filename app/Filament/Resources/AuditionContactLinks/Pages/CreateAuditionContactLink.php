<?php

namespace App\Filament\Resources\AuditionContactLinks\Pages;

use App\Filament\Resources\AuditionContactLinks\AuditionContactLinkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuditionContactLink extends CreateRecord
{
    protected static string $resource = AuditionContactLinkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 'contact_link';

        return $data;
    }
}
