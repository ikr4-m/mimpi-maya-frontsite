<?php

namespace App\Filament\Resources\AuditionSettings;

use App\Filament\Resources\AuditionSettings\Pages\CreateAuditionSetting;
use App\Filament\Resources\AuditionSettings\Pages\EditAuditionSetting;
use App\Filament\Resources\AuditionSettings\Pages\ListAuditionSettings;
use App\Filament\Resources\AuditionSettings\Schemas\AuditionSettingForm;
use App\Filament\Resources\AuditionSettings\Tables\AuditionSettingsTable;
use App\Models\AuditionSetting;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AuditionSettingResource extends Resource
{
    protected static ?string $model = AuditionSetting::class;

    protected static UnitEnum|string|null $navigationGroup = 'Audition';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $label = 'Setting';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    public static function form(Schema $schema): Schema
    {
        return AuditionSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AuditionSettingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAuditionSettings::route('/'),
            'create' => CreateAuditionSetting::route('/create'),
            'edit' => EditAuditionSetting::route('/{record}/edit'),
        ];
    }
}
