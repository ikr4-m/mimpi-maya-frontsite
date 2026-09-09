<?php

namespace App\Filament\Resources\AuditionArchives\Pages;

use App\Filament\Resources\AuditionArchives\AuditionArchiveResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuditionArchives extends ListRecords
{
    protected static string $resource = AuditionArchiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
