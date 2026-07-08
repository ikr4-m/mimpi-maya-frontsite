<?php

namespace App\Filament\Resources\AuditionTimelines\Pages;

use App\Filament\Resources\AuditionTimelines\AuditionTimelineResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuditionTimeline extends CreateRecord
{
    protected static string $resource = AuditionTimelineResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 'timeline';

        return $data;
    }
}
