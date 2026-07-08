<?php

namespace App\Filament\Resources\AuditionSettings\Pages;

use App\Filament\Resources\AuditionSettings\AuditionSettingResource;
use App\Models\AuditionSetting;
use Filament\Resources\Pages\ListRecords;

class ListAuditionSettings extends ListRecords
{
    protected static string $resource = AuditionSettingResource::class;

    public function mount(): void
    {
        $setting = AuditionSetting::first();

        if ($setting) {
            $this->redirect($this->getResource()::getUrl('edit', ['record' => $setting]));
        } else {
            $this->redirect($this->getResource()::getUrl('create'));
        }
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
