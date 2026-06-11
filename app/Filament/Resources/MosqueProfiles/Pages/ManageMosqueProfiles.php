<?php

namespace App\Filament\Resources\MosqueProfiles\Pages;

use App\Filament\Resources\MosqueProfiles\MosqueProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageMosqueProfiles extends ManageRecords
{
    protected static string $resource = MosqueProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
