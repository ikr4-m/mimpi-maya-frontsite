<?php

namespace App\Filament\Resources\AuditionContactLinks\Pages;

use App\Filament\Resources\AuditionContactLinks\AuditionContactLinkResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAuditionContactLink extends EditRecord
{
    protected static string $resource = AuditionContactLinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
