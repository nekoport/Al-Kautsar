<?php

namespace App\Filament\Resources\MosqueProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MosqueProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('Nama Masjid'),
                TextInput::make('address')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Alamat'),
                TextInput::make('phone')
                    ->tel()
                    ->default(null)
                    ->label('Telepon'),
                TextInput::make('email')
                    ->email()
                    ->default(null)
                    ->label('Email'),
                RichEditor::make('history')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Sejarah'),
                RichEditor::make('vision')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Visi'),
                RichEditor::make('mission')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Misi'),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->disk('public')
                    ->directory('mosque')
                    ->default(null)
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->maxSize(2048),
                FileUpload::make('hero_image')
                    ->image()
                    ->label('Gambar Hero')
                    ->disk('public')
                    ->directory('mosque')
                    ->default(null)
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->maxSize(2048),
                FileUpload::make('favicon')
                    ->label('Favicon')
                    ->disk('public')
                    ->directory('mosque')
                    ->default(null)
                    ->acceptedFileTypes(['image/x-icon', 'image/vnd.microsoft.icon'])
                    ->maxSize(500),
                TextInput::make('footer_text')
                    ->default(null)
                    ->label('Teks Footer'),
                TextInput::make('latitude')
                    ->numeric()
                    ->step('any')
                    ->default(null)
                    ->label('Latitude'),
                TextInput::make('longitude')
                    ->numeric()
                    ->step('any')
                    ->default(null)
                    ->label('Longitude'),
            ]);
    }
}
