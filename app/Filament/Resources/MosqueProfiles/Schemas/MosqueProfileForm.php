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
                    ->image()
                    ->default(null)
                    ->label('Logo'),
            ]);
    }
}
