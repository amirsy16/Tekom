<?php

namespace App\Filament\Resources\Inventories\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class InventoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('asset_code')
                    ->label('Kode Aset')
                    ->placeholder('Akan di-generate otomatis')
                    ->disabled(),
                    
                Select::make('organization_id')
                    ->label('Satuan Kerja')
                    ->relationship('organization', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                
                TextInput::make('unit')
                    ->label('Unit')
                    ->placeholder('Bidang/Satuan (Bid TIK, Sat Brimob, dll)')
                    ->maxLength(255),
                    
                Select::make('site_id')
                    ->label('Lokasi Site')
                    ->relationship('site', 'name')
                    ->searchable()
                    ->preload(),
                    
                Select::make('equipment_type_id')
                    ->label('Jenis Perangkat')
                    ->relationship('equipmentType', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                TextInput::make('serial_number')
                    ->label('Serial Number')
                    ->placeholder('S/N Perangkat'),
                    
                TextInput::make('installation_year')
                    ->label('Tahun Instalasi')
                    ->required()
                    ->numeric()
                    ->minValue(1990)
                    ->maxValue(date('Y'))
                    ->default(date('Y')),
                    
                Select::make('condition')
                    ->label('Kondisi')
                    ->options([
                        'BB' => 'Baik (BB)', 
                        'RR' => 'Rusak Ringan (RR)', 
                        'RB' => 'Rusak Berat (RB)'
                    ])
                    ->default('BB')
                    ->required(),
                    
                TextInput::make('quantity')
                    ->label('Jumlah')
                    ->required()
                    ->numeric()
                    ->default(1)
                    ->minValue(1),
                    
                TextInput::make('purchase_price')
                    ->label('Harga Pembelian')
                    ->numeric()
                    ->prefix('Rp')
                    ->placeholder('0'),
                    
                DatePicker::make('last_maintenance')
                    ->label('Maintenance Terakhir')
                    ->displayFormat('d/m/Y'),
                    
                DatePicker::make('next_maintenance')
                    ->label('Maintenance Selanjutnya')
                    ->displayFormat('d/m/Y'),
                    
                Textarea::make('notes')
                    ->label('Catatan')
                    ->placeholder('Catatan tambahan tentang aset ini...')
                    ->columnSpanFull(),
                    
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }
}
