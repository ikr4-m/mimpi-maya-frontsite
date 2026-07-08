<?php

namespace App\Filament\Resources\AuditionContactLinks;

use App\Filament\Resources\AuditionContactLinks\Schemas\ContactLinkFields;
use App\Filament\Resources\AuditionContactLinks\Pages\CreateAuditionContactLink;
use App\Filament\Resources\AuditionContactLinks\Pages\EditAuditionContactLink;
use App\Filament\Resources\AuditionContactLinks\Pages\ListAuditionContactLinks;
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

class AuditionContactLinkResource extends Resource
{
    protected static ?string $model = AuditionContent::class;

    protected static UnitEnum|string|null $navigationGroup = 'Audition';

    protected static ?string $navigationLabel = 'Contact Link';

    protected static ?string $label = 'Contact Link';

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'contact_link');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(ContactLinkFields::components());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->searchable(),
                TextColumn::make('url')
                    ->searchable(),
                TextColumn::make('icon')
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
            'index' => ListAuditionContactLinks::route('/'),
            'create' => CreateAuditionContactLink::route('/create'),
            'edit' => EditAuditionContactLink::route('/{record}/edit'),
        ];
    }
}
