<?php

namespace App\Filament\Resources\Announcements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnnouncementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->label('Judul'),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->label('Konten'),
                Toggle::make('is_active')
                    ->required()
                    ->label('Aktif'),
                DateTimePicker::make('expires_at')
                    ->label('Tanggal Kedaluwarsa'),
            ]);
    }
}
