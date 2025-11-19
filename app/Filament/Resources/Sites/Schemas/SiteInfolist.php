<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('Nama Site'),
                TextEntry::make('ownership')
                    ->label('Status Site')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('towers_count')
                    ->label('Jumlah Tower')
                    ->state(fn ($record) => $record->towers()->count())
                    ->placeholder('0'),
                TextEntry::make('coordinates')
                    ->label('Koordinat')
                    ->state(fn ($record) => filled($record->latitude) && filled($record->longitude)
                        ? sprintf('%s, %s', $record->latitude, $record->longitude)
                        : null)
                    ->placeholder('-'),
                TextEntry::make('location')
                    ->label('Alamat / Lokasi Asli')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('description')
                    ->label('Catatan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Diubah')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
