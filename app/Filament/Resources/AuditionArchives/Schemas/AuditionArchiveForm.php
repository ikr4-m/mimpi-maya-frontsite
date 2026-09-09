<?php

namespace App\Filament\Resources\AuditionArchives\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
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
                FileUpload::make('thumbnails')
                    ->label('OG / Thumbnail Images')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->appendFiles()
                    ->imageEditor()
                    ->directory('audition/thumbnails')
                    ->disk('public')
                    ->visibility('public')
                    ->helperText('Upload one or multiple images for social cards and rotated previews.')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->label('Audition Description')
                    ->columnSpanFull(),
            ]);
    }
}
