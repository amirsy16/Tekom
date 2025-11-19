<?php

namespace App\Filament\Resources\UserActivities\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('action')
                    ->required(),
                TextInput::make('module'),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('ip_address'),
                Textarea::make('user_agent')
                    ->columnSpanFull(),
                TextInput::make('url')
                    ->url(),
                TextInput::make('method'),
                TextInput::make('old_values'),
                TextInput::make('new_values'),
                DateTimePicker::make('performed_at')
                    ->required(),
            ]);
    }
}
