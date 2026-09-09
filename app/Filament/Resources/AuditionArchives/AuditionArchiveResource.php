<?php

namespace App\Filament\Resources\AuditionArchives;

use App\Filament\Resources\AuditionArchives\Pages\CreateAuditionArchive;
use App\Filament\Resources\AuditionArchives\Pages\EditAuditionArchive;
use App\Filament\Resources\AuditionArchives\Pages\ListAuditionArchives;
use App\Filament\Resources\AuditionArchives\Schemas\AuditionArchiveForm;
use App\Filament\Resources\AuditionArchives\Tables\AuditionArchivesTable;
use App\Models\AuditionArchive;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AuditionArchiveResource extends Resource
{
    protected static ?string $model = AuditionArchive::class;

    protected static UnitEnum|string|null $navigationGroup = 'Audition';

    protected static ?string $navigationLabel = 'Audition Archived';

    protected static ?string $label = 'Audition Archived';

    protected static ?string $pluralLabel = 'Audition Archived';

    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    public static function form(Schema $schema): Schema
    {
        return AuditionArchiveForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AuditionArchivesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAuditionArchives::route('/'),
            'create' => CreateAuditionArchive::route('/create'),
            'edit' => EditAuditionArchive::route('/{record}/edit'),
        ];
    }
}
