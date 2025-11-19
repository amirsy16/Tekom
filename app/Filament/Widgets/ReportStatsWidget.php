<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Inventory;
use App\Models\Organization;
use App\Models\Site;
use App\Models\EquipmentType;

class ReportStatsWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    
    protected function getStats(): array
    {
        return [
            Stat::make('Total Aset', Inventory::active()->count())
                ->description('Total inventaris aktif')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            
            Stat::make('Satuan Kerja', Organization::active()->count())
                ->description('Organisasi terdaftar')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('success')
                ->chart([15, 4, 10, 2, 12, 4, 12]),
            
            Stat::make('Total Site', Site::active()->count())
                ->description('Lokasi site komunikasi')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('warning')
                ->chart([10, 15, 13, 8, 14, 10, 12]),
            
            Stat::make('Jenis Perangkat', EquipmentType::active()->count())
                ->description('Kategori peralatan')
                ->descriptionIcon('heroicon-m-cpu-chip')
                ->color('danger')
                ->chart([3, 7, 5, 8, 6, 9, 7]),
        ];
    }
}
