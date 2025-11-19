<?php

namespace App\Filament\Resources\Towers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TowerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('repeater_type')
                    ->label('Tipe Repeater')
                    ->required()
                    ->maxLength(255),
                Select::make('system')
                    ->label('Sistem')
                    ->options([
                        'CONV' => 'Konvensional',
                        'TRUNKING' => 'Trunking',
                        'DATA' => 'Data',
                    ])
                    ->native(false)
                    ->searchable(),
                TextInput::make('frequency_rx')
                    ->label('Frekuensi RX (MHz)')
                    ->maxLength(32)
                    ->placeholder('855.8125')
                    ->helperText('Gunakan titik untuk desimal, contoh 855.8125'),
                TextInput::make('frequency_tx')
                    ->label('Frekuensi TX (MHz)')
                    ->maxLength(32)
                    ->placeholder('810.8125')
                    ->helperText('Gunakan titik untuk desimal, contoh 810.8125'),
                Select::make('site_status')
                    ->label('Pemilik Site')
                    ->options([
                        'POLRI' => 'POLRI',
                        'TELKOM' => 'TELKOM',
                        'TVRI' => 'TVRI',
                        'INDOSAT' => 'INDOSAT',
                        'SWASTA' => 'SWASTA',
                        'LAINNYA' => 'LAINNYA',
                    ])
                    ->native(false)
                    ->searchable(),
                TextInput::make('tower_structure')
                    ->label('Jenis Tower')
                    ->maxLength(50),
                TextInput::make('tower_height')
                    ->label('Tinggi Tower')
                    ->maxLength(50),
                TextInput::make('condition_bb')
                    ->label('Kondisi BB')
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('1'),
                TextInput::make('condition_rr')
                    ->label('Kondisi RR')
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('0'),
                TextInput::make('condition_rb')
                    ->label('Kondisi RB')
                    ->numeric()
                    ->minValue(0)
                    ->placeholder('0'),
                TextInput::make('documentation')
                    ->label('Dokumentasi')
                    ->maxLength(255),
                TextInput::make('user')
                    ->label('Pengguna')
                    ->maxLength(255),
                Textarea::make('notes')
                    ->label('Keterangan')
                    ->maxLength(1000)
                    ->columnSpanFull(),
            ]);
    }
}
