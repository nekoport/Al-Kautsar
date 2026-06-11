<?php

namespace App\Filament\Resources\DonationInfos;

use App\Filament\Resources\DonationInfos\Pages\ManageDonationInfos;
use App\Filament\Resources\DonationInfos\Schemas\DonationInfoForm;
use App\Filament\Resources\DonationInfos\Tables\DonationInfosTable;
use App\Models\DonationInfo;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DonationInfoResource extends Resource
{
    protected static ?string $model = DonationInfo::class;

    protected static ?string $navigationLabel = 'Info Donasi';

    protected static ?string $modelLabel = 'Info Donasi';

    protected static ?string $pluralModelLabel = 'Info Donasi';


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return DonationInfoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DonationInfosTable::configure($table);
    }

        public static function getNavigationGroup(): string | UnitEnum | null
    {
        return 'Manajemen';
    }
public static function getPages(): array
    {
        return [
            'index' => ManageDonationInfos::route('/'),
        ];
    }
}




