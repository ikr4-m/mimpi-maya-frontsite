<?php

namespace App\Filament\Resources\AuditionTimelines\Pages;

use App\Filament\Resources\AuditionTimelines\AuditionTimelineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAuditionTimeline extends EditRecord
{
    protected static string $resource = AuditionTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
