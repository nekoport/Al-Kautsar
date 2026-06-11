<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('album_name')
                    ->required()
                    ->label('Nama Album'),
                RichEditor::make('description')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Deskripsi'),
                FileUpload::make('cover_image')
                    ->image()
                    ->label('Gambar Sampul'),
            ]);
    }
}
