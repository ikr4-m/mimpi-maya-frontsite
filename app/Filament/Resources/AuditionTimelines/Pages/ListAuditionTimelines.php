<?php

namespace App\Filament\Resources\AuditionTimelines\Pages;

use App\Filament\Resources\AuditionTimelines\AuditionTimelineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuditionTimelines extends ListRecords
{
    protected static string $resource = AuditionTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
