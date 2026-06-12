<?php

namespace App\Filament\Resources\MosqueProfiles\Pages;

use App\Filament\Resources\MosqueProfiles\MosqueProfileResource;
use Filament\Resources\Pages\EditRecord;

class EditMosqueProfile extends EditRecord
{
    protected static string $resource = MosqueProfileResource::class;

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }
}
