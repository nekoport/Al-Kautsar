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
                TextColumn::make('bank_name')
                    ->searchable()
                    ->label('Nama Bank'),
                TextColumn::make('account_number')
                    ->searchable()
                    ->label('Nomor Rekening'),
                TextColumn::make('account_name')
                    ->searchable()
                    ->label('Atas Nama'),
                ImageColumn::make('qris_image')
                    ->label('QRIS'),
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
