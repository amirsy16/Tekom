<?php

namespace App\Filament\Resources\Sites\Schemas;

use App\Models\Organization;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SiteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('organization_id')
                    ->label('Satuan Kerja')
                    ->options(fn () => Organization::active()->orderBy('name')->pluck('name', 'id')->all())
                    ->searchable()
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Nama Site')
                    ->required()
                    ->maxLength(255),
                TextInput::make('location')
                    ->label('Alamat / Titik Koordinat Asli')
                    ->maxLength(255)
                    ->placeholder('Titik koordinat atau alamat ringkas'),
                Select::make('ownership')
                    ->label('Status Site')
                    ->options([
                        'POLRI' => 'POLRI',
                        'TELKOM' => 'TELKOM',
                        'TVRI' => 'TVRI',
                        'INDOSAT' => 'INDOSAT',
                        'SWASTA' => 'SWASTA',
                        'LAINNYA' => 'LAINNYA',
                    ])
                    ->searchable()
                    ->required(),
                TextInput::make('latitude')
                    ->label('Latitude')
                    ->numeric()
                    ->step(0.00000001)
                    ->placeholder('-1.61125000'),
                TextInput::make('longitude')
                    ->label('Longitude')
                    ->numeric()
                    ->step(0.00000001)
                    ->placeholder('103.62378000'),
                Textarea::make('description')
                    ->label('Deskripsi / Catatan')
                    ->placeholder('Catatan tambahan mengenai site atau akses ke tower')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
