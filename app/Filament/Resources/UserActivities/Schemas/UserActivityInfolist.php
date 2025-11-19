<?php

namespace App\Filament\Resources\UserActivities\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserActivityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User')
                    ->placeholder('-'),
                TextEntry::make('action'),
                TextEntry::make('module')
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('ip_address')
                    ->placeholder('-'),
                TextEntry::make('user_agent')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('url')
                    ->placeholder('-'),
                TextEntry::make('method')
                    ->placeholder('-'),
                TextEntry::make('performed_at')
                    ->dateTime(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
