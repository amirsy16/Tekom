<?php

namespace App\Filament\Resources\Inventories\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InventoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('asset_code'),
                TextEntry::make('organization.name')
                    ->label('Satuan Kerja'),
                TextEntry::make('site.name')
                    ->label('Site'),
                TextEntry::make('equipmentType.name')
                    ->label('Equipment type'),
                TextEntry::make('serial_number')
                    ->placeholder('-'),
                TextEntry::make('installation_year'),
                TextEntry::make('condition')
                    ->badge(),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('purchase_price')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('last_maintenance')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('next_maintenance')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_active')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
