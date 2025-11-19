<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Role;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                    
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                    
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->minLength(8)
                    ->helperText('Minimal 8 karakter. Kosongkan jika tidak ingin mengubah password.'),
                    
                DateTimePicker::make('email_verified_at')
                    ->label('Email Terverifikasi Pada')
                    ->displayFormat('d/m/Y H:i')
                    ->helperText('Kosongkan jika email belum terverifikasi'),
                    
                CheckboxList::make('roles')
                    ->label('Peran Pengguna')
                    ->relationship('roles', 'name')
                    ->options(Role::active()->pluck('name', 'id'))
                    ->descriptions(Role::active()->pluck('description', 'id')->toArray())
                    ->columns(2)
                    ->columnSpanFull()
                    ->searchable()
                    ->helperText('Pilih satu atau lebih peran untuk pengguna ini'),
            ]);
    }
}
