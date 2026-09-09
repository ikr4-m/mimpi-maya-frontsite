<?php

namespace App\Filament\Resources\AuditionArchives\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AuditionArchiveForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Audition Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label('Slug Link')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('URL identifier or external URL, e.g. "chapter-02"'),
                DateTimePicker::make('audition_start')
                    ->label('Start Audition')
                    ->required(),
                DateTimePicker::make('audition_end')
                    ->label('End Audition')
                    ->required(),
                Textarea::make('description')
                    ->label('Audition Description')
                    ->columnSpanFull(),
            ]);
    }
}
