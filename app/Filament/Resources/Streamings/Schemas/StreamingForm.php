<?php

namespace App\Filament\Resources\Streamings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class StreamingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->label('Judul'),
                TextInput::make('youtube_url')
                    ->url()
                    ->required()
                    ->label('URL YouTube'),
                Toggle::make('is_live')
                    ->required()
                    ->label('Siaran Langsung'),
                DateTimePicker::make('scheduled_at')
                    ->label('Jadwal Tayang'),
            ]);
    }
}
