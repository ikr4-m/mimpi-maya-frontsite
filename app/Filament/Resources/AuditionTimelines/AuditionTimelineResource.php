<?php

namespace App\Filament\Resources\AuditionTimelines;

use App\Filament\Resources\AuditionTimelines\Schemas\TimelineFields;
use App\Filament\Resources\AuditionTimelines\Pages\CreateAuditionTimeline;
use App\Filament\Resources\AuditionTimelines\Pages\EditAuditionTimeline;
use App\Filament\Resources\AuditionTimelines\Pages\ListAuditionTimelines;
use App\Models\AuditionContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class AuditionTimelineResource extends Resource
{
    protected static ?string $model = AuditionContent::class;

    protected static UnitEnum|string|null $navigationGroup = 'Audition';

    protected static ?string $navigationLabel = 'Timeline';

    protected static ?string $label = 'Timeline';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'timeline');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(TimelineFields::components());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAuditionTimelines::route('/'),
            'create' => CreateAuditionTimeline::route('/create'),
            'edit' => EditAuditionTimeline::route('/{record}/edit'),
        ];
    }
}
