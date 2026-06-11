<?php

namespace App\Filament\Resources\GalleryItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('gallery_id')
                    ->relationship('gallery', 'album_name')
                    ->required()
                    ->label('Galeri'),
                FileUpload::make('image_path')
                    ->image()
                    ->required()
                    ->label('Gambar'),
                TextInput::make('caption')
                    ->default(null)
                    ->label('Keterangan'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('Urutan'),
            ]);
    }
}
