<?php

namespace App\Filament\Resources\MosqueProfiles;

use App\Filament\Resources\MosqueProfiles\Pages\EditMosqueProfile;
use App\Filament\Resources\MosqueProfiles\Pages\ManageMosqueProfiles;
use App\Filament\Resources\MosqueProfiles\Schemas\MosqueProfileForm;
use App\Filament\Resources\MosqueProfiles\Tables\MosqueProfilesTable;
use App\Models\MosqueProfile;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MosqueProfileResource extends Resource
{
    protected static ?string $model = MosqueProfile::class;

    protected static ?string $navigationLabel = 'Profil Masjid';

    protected static ?string $modelLabel = 'Profil Masjid';

    protected static ?string $pluralModelLabel = 'Profil Masjid';


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return MosqueProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MosqueProfilesTable::configure($table);
    }

        public static function canCreate(): bool
    {
        return \App\Models\MosqueProfile::count() === 0;
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return 'Manajemen';
    }
public static function getPages(): array
    {
        return [
            'index' => ManageMosqueProfiles::route('/'),
            'edit' => EditMosqueProfile::route('/{record}/edit'),
        ];
    }
}




