<?php

namespace App\Filament\Resources\AuditionArchives\Pages;

use App\Filament\Resources\AuditionArchives\AuditionArchiveResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAuditionArchive extends EditRecord
{
    protected static string $resource = AuditionArchiveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
