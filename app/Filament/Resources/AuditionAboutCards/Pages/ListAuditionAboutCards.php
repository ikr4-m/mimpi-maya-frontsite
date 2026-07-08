<?php

namespace App\Filament\Resources\AuditionAboutCards\Pages;

use App\Filament\Resources\AuditionAboutCards\AuditionAboutCardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAuditionAboutCards extends ListRecords
{
    protected static string $resource = AuditionAboutCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
