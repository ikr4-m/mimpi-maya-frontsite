<?php

namespace App\Filament\Resources\AuditionBenefits;

use App\Filament\Resources\Audition\Schemas\TypeForms\BenefitFields;
use App\Filament\Resources\AuditionBenefits\Pages\CreateAuditionBenefit;
use App\Filament\Resources\AuditionBenefits\Pages\EditAuditionBenefit;
use App\Filament\Resources\AuditionBenefits\Pages\ListAuditionBenefits;
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

class AuditionBenefitResource extends Resource
{
    protected static ?string $model = AuditionContent::class;

    protected static UnitEnum|string|null $navigationGroup = 'Audition';

    protected static ?string $navigationLabel = 'Benefit';

    protected static ?string $label = 'Benefit';

    protected static ?int $navigationSort = 3;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'benefit');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components(BenefitFields::components());
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
            'index' => ListAuditionBenefits::route('/'),
            'create' => CreateAuditionBenefit::route('/create'),
            'edit' => EditAuditionBenefit::route('/{record}/edit'),
        ];
    }
}
