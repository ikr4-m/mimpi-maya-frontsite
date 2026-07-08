<?php

namespace App\Filament\Resources\AuditionAboutCards;

use App\Filament\Resources\Audition\Schemas\TypeForms\AboutCardFields;
use App\Filament\Resources\AuditionAboutCards\Pages\CreateAuditionAboutCard;
use App\Filament\Resources\AuditionAboutCards\Pages\EditAuditionAboutCard;
use App\Filament\Resources\AuditionAboutCards\Pages\ListAuditionAboutCards;
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

class AuditionAboutCardResource extends Resource
{
    protected static ?string $model = AuditionContent::class;

    protected static UnitEnum|string|null $navigationGroup = 'Audition';

    protected static ?string $navigationLabel = 'About Card';

    protected static ?string $label = 'About Card';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'about_card');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(AboutCardFields::components());
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
            'index' => ListAuditionAboutCards::route('/'),
            'create' => CreateAuditionAboutCard::route('/create'),
            'edit' => EditAuditionAboutCard::route('/{record}/edit'),
        ];
    }
}
