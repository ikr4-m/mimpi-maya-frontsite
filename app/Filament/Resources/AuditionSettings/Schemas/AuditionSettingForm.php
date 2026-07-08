<?php

namespace App\Filament\Resources\AuditionSettings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AuditionSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('form_url')
                    ->url(),
                DateTimePicker::make('audition_start')
                    ->required(),
                DateTimePicker::make('audition_end')
                    ->required(),
                TextInput::make('tagline'),
                TextInput::make('about_title'),
                Textarea::make('about_description')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
