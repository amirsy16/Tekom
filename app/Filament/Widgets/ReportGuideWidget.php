<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ReportGuideWidget extends Widget
{
    protected static bool $isDiscovered = false;
    
    protected string $view = 'filament.widgets.report-guide-widget';
    
    protected int | string | array $columnSpan = 'full';
}
