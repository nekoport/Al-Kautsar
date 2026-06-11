<?php

namespace App\Filament\Resources\DonationInfos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DonationInfoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->required()
                    ->label('Jenis Donasi')
                    ->options([
                        'bank' => 'Transfer Bank',
                        'qris' => 'QRIS',
                    ])
                    ->default('bank')
                    ->live(),
                TextInput::make('bank_name')
                    ->required()
                    ->label('Nama Bank')
                    ->visible(fn ($get) => $get('type') === 'bank'),
                TextInput::make('account_number')
                    ->required()
                    ->label('Nomor Rekening')
                    ->visible(fn ($get) => $get('type') === 'bank'),
                TextInput::make('account_name')
                    ->required()
                    ->label('Atas Nama')
                    ->visible(fn ($get) => $get('type') === 'bank'),
                FileUpload::make('qris_image')
                    ->image()
                    ->disk('public')
                    ->directory('qris')
                    ->label('Gambar QRIS')
                    ->visible(fn ($get) => $get('type') === 'qris'),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Catatan'),
            ]);
    }
}
