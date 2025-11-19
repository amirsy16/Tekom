<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Inventory;

class InventoryOverviewWidget extends BaseWidget
{
    protected static bool $isDiscovered = false;
    
    protected function getStats(): array
    {
        $totalInventory = Inventory::active()->count();
        $conditionBB = Inventory::active()->where('condition', 'BB')->count();
        $conditionRR = Inventory::active()->where('condition', 'RR')->count();
        $conditionRB = Inventory::active()->where('condition', 'RB')->count();
        
        // Calculate percentages
        $percentBB = $totalInventory > 0 ? round(($conditionBB / $totalInventory) * 100, 1) : 0;
        $percentRR = $totalInventory > 0 ? round(($conditionRR / $totalInventory) * 100, 1) : 0;
        $percentRB = $totalInventory > 0 ? round(($conditionRB / $totalInventory) * 100, 1) : 0;

        return [
            Stat::make('Total Inventaris', number_format($totalInventory))
                ->description('Total aset terdaftar')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary')
                ->chart([7, 12, 10, 15, 13, 18, 17]),
            
            Stat::make('Kondisi Baik (BB)', number_format($conditionBB))
                ->description($percentBB . '% dari total')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart([10, 12, 15, 18, 20, 22, 25]),
            
            Stat::make('Kondisi Rusak Ringan (RR)', number_format($conditionRR))
                ->description($percentRR . '% dari total')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning')
                ->chart([5, 7, 6, 8, 7, 9, 8]),
            
            Stat::make('Kondisi Rusak Berat (RB)', number_format($conditionRB))
                ->description($percentRB . '% dari total')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger')
                ->chart([3, 2, 4, 3, 5, 4, 6]),
        ];
    }
}
