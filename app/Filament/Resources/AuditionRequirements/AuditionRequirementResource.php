<?php

namespace App\Filament\Resources\AuditionRequirements;

use App\Filament\Resources\AuditionRequirements\Schemas\RequirementFields;
use App\Filament\Resources\AuditionRequirements\Pages\CreateAuditionRequirement;
use App\Filament\Resources\AuditionRequirements\Pages\EditAuditionRequirement;
use App\Filament\Resources\AuditionRequirements\Pages\ListAuditionRequirements;
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

class AuditionRequirementResource extends Resource
{
    protected static ?string $model = AuditionContent::class;

    protected static UnitEnum|string|null $navigationGroup = 'Audition';

    protected static ?string $navigationLabel = 'Requirement';

    protected static ?string $label = 'Requirement';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'requirement');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(RequirementFields::components());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('icon')
                    ->searchable(),
                TextColumn::make('title')
                    ->searchable(),
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
            'index' => ListAuditionRequirements::route('/'),
            'create' => CreateAuditionRequirement::route('/create'),
            'edit' => EditAuditionRequirement::route('/{record}/edit'),
        ];
    }
}
