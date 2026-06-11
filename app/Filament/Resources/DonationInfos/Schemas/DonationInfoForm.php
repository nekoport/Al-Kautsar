<?php

namespace App\Filament\Resources\DonationInfos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DonationInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('bank_name')
                    ->required()
                    ->label('Nama Bank'),
                TextInput::make('account_number')
                    ->required()
                    ->label('Nomor Rekening'),
                TextInput::make('account_name')
                    ->required()
                    ->label('Atas Nama'),
                FileUpload::make('qris_image')
                    ->image()
                    ->label('Gambar QRIS'),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Catatan'),
            ]);
    }
}
