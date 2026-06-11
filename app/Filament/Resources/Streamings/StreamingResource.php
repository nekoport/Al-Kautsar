<?php

namespace App\Filament\Resources\Streamings;

use App\Filament\Resources\Streamings\Pages\CreateStreaming;
use App\Filament\Resources\Streamings\Pages\EditStreaming;
use App\Filament\Resources\Streamings\Pages\ListStreamings;
use App\Filament\Resources\Streamings\Schemas\StreamingForm;
use App\Filament\Resources\Streamings\Tables\StreamingsTable;
use App\Models\Streaming;
use BackedEnum;
use Filament\Resources\Resource;
use UnitEnum;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StreamingResource extends Resource
{
    protected static ?string $model = Streaming::class;

    protected static ?string $navigationLabel = 'Streaming';

    protected static ?string $modelLabel = 'Streaming';

    protected static ?string $pluralModelLabel = 'Streaming';


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedVideoCamera;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return StreamingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StreamingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

        public static function getNavigationGroup(): string | UnitEnum | null
    {
        return 'Konten';
    }
public static function getPages(): array
    {
        return [
            'index' => ListStreamings::route('/'),
            'create' => CreateStreaming::route('/create'),
            'edit' => EditStreaming::route('/{record}/edit'),
        ];
    }
}




