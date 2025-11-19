<?php

namespace App\Filament\Resources\Organizations\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrganizationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('code')
                    ->label('Kode Satuan')
                    ->copyable()
                    ->icon('heroicon-m-clipboard'),
                TextEntry::make('name')
                    ->label('Nama Satuan Kerja')
                    ->size('lg')
                    ->weight('bold'),
                TextEntry::make('type')
                    ->label('Jenis Satuan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'POLDA' => 'success',
                        'POLRESTA' => 'info',
                        'POLRES' => 'warning',
                        'POLSEK' => 'gray',
                        'SATUAN' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('parent.name')
                    ->label('Satuan Induk')
                    ->placeholder('Tidak Ada Induk')
                    ->icon('heroicon-m-building-office'),
                TextEntry::make('address')
                    ->label('Alamat')
                    ->placeholder('Alamat tidak tersedia')
                    ->icon('heroicon-m-map-pin')
                    ->columnSpanFull(),
                IconEntry::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextEntry::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i:s')
                    ->icon('heroicon-m-calendar')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime('d/m/Y H:i:s')
                    ->icon('heroicon-m-pencil')
                    ->placeholder('-'),
            ]);
    }
}
