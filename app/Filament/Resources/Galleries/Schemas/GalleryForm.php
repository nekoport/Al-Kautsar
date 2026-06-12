<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
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
                    ->disk('public')
                    ->directory('galleries')
                    ->label('Gambar Sampul')
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->maxSize(2048),
                Repeater::make('items')
                    ->relationship()
                    ->schema([
                        FileUpload::make('image_path')
                            ->image()
                            ->disk('public')
                            ->directory('gallery-items')
                            ->required()
                            ->label('Gambar')
                            ->acceptedFileTypes(['image/jpeg', 'image/png'])
                            ->maxSize(2048),
                        TextInput::make('caption')
                            ->default(null)
                            ->label('Keterangan'),
                    ])
                    ->orderColumn('order')
                    ->defaultItems(0)
                    ->label('Foto-foto')
                    ->columnSpanFull(),
            ]);
    }
}
