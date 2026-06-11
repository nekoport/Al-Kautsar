<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->label('Nama'),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('Email'),
                DateTimePicker::make('email_verified_at')
                    ->label('Tanggal Verifikasi Email'),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->label('Kata Sandi'),
            ]);
    }
}
