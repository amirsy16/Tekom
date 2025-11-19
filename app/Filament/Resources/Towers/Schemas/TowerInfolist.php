<?php

namespace App\Filament\Resources\Towers\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TowerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('site.name')
                    ->label('Site')
                    ->placeholder('-'),
                TextEntry::make('repeater_type')
                    ->label('Tipe Repeater')
                    ->placeholder('-'),
                TextEntry::make('system')
                    ->label('Sistem')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('frequency_rx')
                    ->label('Frekuensi RX')
                    ->placeholder('-'),
                TextEntry::make('frequency_tx')
                    ->label('Frekuensi TX')
                    ->placeholder('-'),
                TextEntry::make('site_status')
                    ->label('Pemilik Site')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('tower_structure')
                    ->label('Jenis Tower')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('tower_height')
                    ->label('Tinggi Tower')
                    ->placeholder('-'),
                TextEntry::make('condition_bb')
                    ->label('Kondisi BB')
                    ->placeholder('-'),
                TextEntry::make('condition_rr')
                    ->label('Kondisi RR')
                    ->placeholder('-'),
                TextEntry::make('condition_rb')
                    ->label('Kondisi RB')
                    ->placeholder('-'),
                TextEntry::make('documentation')
                    ->label('Dokumentasi')
                    ->placeholder('-'),
                TextEntry::make('user')
                    ->label('Pengguna')
                    ->placeholder('-'),
                TextEntry::make('notes')
                    ->label('Keterangan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                IconEntry::make('site.is_active')
                    ->label('Site Aktif')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
