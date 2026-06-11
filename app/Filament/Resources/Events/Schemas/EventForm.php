<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class EventForm
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
                RichEditor::make('description')
                    ->default(null)
                    ->columnSpanFull()
                    ->label('Deskripsi'),
                TextInput::make('location')
                    ->default(null)
                    ->label('Lokasi'),
                DateTimePicker::make('start_date')
                    ->required()
                    ->label('Tanggal Mulai'),
                DateTimePicker::make('end_date')
                    ->label('Tanggal Selesai'),
                Toggle::make('is_active')
                    ->required()
                    ->label('Aktif'),
            ]);
    }
}
