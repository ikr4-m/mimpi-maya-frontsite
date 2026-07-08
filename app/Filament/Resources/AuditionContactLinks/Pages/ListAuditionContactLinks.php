<?php

namespace App\Filament\Resources\AuditionContactLinks\Pages;

use App\Filament\Resources\AuditionContactLinks\AuditionContactLinkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuditionContactLinks extends ListRecords
{
    protected static string $resource = AuditionContactLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
