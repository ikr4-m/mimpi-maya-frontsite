<?php

namespace App\Filament\Resources\AuditionSettings\Schemas;

use App\Models\AuditionArchive;
use Closure;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class AuditionSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('slug')
                    ->label('Audition')
                    ->options(fn () => AuditionArchive::pluck('name', 'slug')->toArray())
                    ->searchable()
                    ->nullable()
                    ->live()
                    ->helperText('Select an archived audition to activate')
                    ->rules([
                        fn (Get $get) => function (string $attribute, $value, Closure $fail) use ($get) {
                            if (filled($value) && ! $get('is_active')) {
                                $fail('Audition cannot be selected when isActive is false.');
                            }
                        },
                    ]),
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
                    ->required()
                    ->live(),
            ]);
    }
}
