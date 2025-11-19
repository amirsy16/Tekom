<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class TowerMapWidget extends Widget
{
    protected string $view = 'filament.widgets.tower-map-widget';

    protected int | string | array $columnSpan = 'full';

    protected function getHeading(): string
    {
        return 'Peta Lokasi Tower';
    }
}
