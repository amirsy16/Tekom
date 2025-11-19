<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class OrganizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode Satuan')
                    ->required()
                    ->maxLength(20),
                TextInput::make('name')
                    ->label('Nama Satuan Kerja')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Jenis Satuan')
                    ->options([
                        'POLDA' => 'POLDA (Kepolisian Daerah)',
                        'POLRESTA' => 'POLRESTA (Kepolisian Resort Kota)',
                        'POLRES' => 'POLRES (Kepolisian Resort)',
                        'POLSEK' => 'POLSEK (Kepolisian Sektor)',
                        'SATUAN' => 'SATUAN KHUSUS',
                    ])
                    ->required(),
                Select::make('parent_id')
                    ->label('Satuan Induk')
                    ->relationship('parent', 'name')
                    ->searchable()
                    ->preload(),
                Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull()
                    ->rows(3),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }
}
