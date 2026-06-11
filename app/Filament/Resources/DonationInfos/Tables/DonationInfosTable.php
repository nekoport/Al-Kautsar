<?php

namespace App\Filament\Resources\DonationInfos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DonationInfosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('type')
                    ->badge()
                    ->label('Jenis')
                    ->formatStateUsing(fn ($state) => $state === 'bank' ? 'Transfer Bank' : 'QRIS')
                    ->colors([
                        'success' => 'bank',
                        'info' => 'qris',
                    ]),
                TextColumn::make('bank_name')
                    ->searchable()
                    ->label('Nama Bank')
                    ->visible(fn ($record) => $record && $record->type === 'bank'),
                TextColumn::make('account_number')
                    ->searchable()
                    ->label('Nomor Rekening')
                    ->visible(fn ($record) => $record && $record->type === 'bank'),
                TextColumn::make('account_name')
                    ->searchable()
                    ->label('Atas Nama')
                    ->visible(fn ($record) => $record && $record->type === 'bank'),
                ImageColumn::make('qris_image')
                    ->label('QRIS')
                    ->visible(fn ($record) => $record && $record->type === 'qris'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
