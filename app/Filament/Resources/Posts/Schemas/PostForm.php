<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->label('Judul'),
                TextInput::make('slug')
                    ->required()
                    ->label('Slug'),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->label('Konten'),
                TextInput::make('excerpt')
                    ->default(null)
                    ->label('Ringkasan'),
                FileUpload::make('thumbnail')
                    ->image()
                    ->default(null)
                    ->label('Thumbnail'),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('Kategori'),
                Hidden::make('user_id')
                    ->default(fn() => auth()->id()),
                DateTimePicker::make('published_at')
                    ->label('Tanggal Publikasi'),
            ]);
    }
}
