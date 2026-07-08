<?php

namespace App\Filament\Resources\Audition\Schemas\TypeForms;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class AboutCardFields
{
    public static function components(): array
    {
        return [
            TextInput::make('icon')
                ->required(),
            TextInput::make('title')
                ->required(),
            Textarea::make('description')
                ->columnSpanFull(),
            TextInput::make('sort_order')
                ->required()
                ->numeric()
                ->default(0),
            Toggle::make('is_active')
                ->required(),
        ];
    }
}
