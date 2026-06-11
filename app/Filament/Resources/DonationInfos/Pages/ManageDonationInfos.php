<?php

namespace App\Filament\Resources\DonationInfos\Pages;

use App\Filament\Resources\DonationInfos\DonationInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDonationInfos extends ManageRecords
{
    protected static string $resource = DonationInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
