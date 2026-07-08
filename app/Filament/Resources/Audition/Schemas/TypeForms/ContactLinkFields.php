<?php

namespace App\Filament\Resources\Audition\Schemas\TypeForms;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ContactLinkFields
{
    public static function components(): array
    {
        return [
            TextInput::make('label')
                ->required(),
            TextInput::make('url')
                ->required()
                ->url(),
            TextInput::make('icon')
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
