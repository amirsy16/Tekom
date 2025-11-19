<?php

namespace App\Filament\Resources\Reports;

use App\Filament\Resources\Reports\Pages\ListReports;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class ReportResource extends Resource
{
    protected static ?string $model = null;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Laporan';
    
    protected static ?string $pluralModelLabel = 'Laporan';
    
    protected static ?string $modelLabel = 'Laporan';
    
    protected static ?int $navigationSort = 50;

    public static function getPages(): array
    {
        return [
            'index' => ListReports::route('/'),
        ];
    }
}