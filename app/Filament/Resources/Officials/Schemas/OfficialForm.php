<?php

namespace App\Filament\Resources\Officials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OfficialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('Nama'),
                TextInput::make('position')
                    ->required()
                    ->label('Jabatan'),
                FileUpload::make('photo')
                    ->image()
                    ->disk('public')
                    ->directory('officials')
                    ->default(null)
                    ->label('Foto')
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])
                    ->maxSize(2048),
                RichEditor::make('bio')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Biografi'),
                TextInput::make('order')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->label('Urutan'),
                Toggle::make('is_active')
                    ->required()
                    ->label('Aktif'),
            ]);
    }
}
