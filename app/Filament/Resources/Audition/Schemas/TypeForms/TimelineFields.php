<?php

namespace App\Filament\Resources\Audition\Schemas\TypeForms;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class TimelineFields
{
    public static function components(): array
    {
        return [
            TextInput::make('title')
                ->required(),
            Textarea::make('description')
                ->columnSpanFull(),
            DateTimePicker::make('date')
                ->required(),
            TextInput::make('sort_order')
                ->required()
                ->numeric()
                ->default(0),
            Toggle::make('is_active')
                ->required(),
        ];
    }
}
