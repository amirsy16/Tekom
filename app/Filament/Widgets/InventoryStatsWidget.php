<?php

namespace App\Filament\Widgets;

use App\Models\Inventory;
use App\Models\Site;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;

class InventoryStatsWidget extends BaseWidget
{
    /**
     * @var array<string, mixed>
     */
    public array $pageFilters = [];

    protected $listeners = [
        'dashboard-filters.synced' => 'handleFiltersSynced',
    ];

    public function updatedPageFilters(): void
    {
        $this->cachedStats = null;
    }

    public function handleFiltersSynced(array $filters): void
    {
        $this->pageFilters = $filters;
        $this->cachedStats = null;
    }

    protected function getStats(): array
    {
        $inventoryQuery = Inventory::query()->active();
        $this->applyFiltersToInventoryBuilder($inventoryQuery);

        $siteQuery = Site::query();
        $this->applyFiltersToSiteBuilder($siteQuery);

        return $this->makeInventoryCategoryStats($inventoryQuery, $siteQuery);
    }

    protected function getSelectedOrganizationId(): ?int
    {
        $organizationId = $this->pageFilters['organization_id'] ?? null;

        if (blank($organizationId)) {
            return null;
        }

        return (int) $organizationId;
    }

    protected function getSelectedOrganizationType(): ?string
    {
        return $this->pageFilters['organization_type'] ?? null;
    }

    protected function getSelectedEquipmentTypeId(): ?int
    {
        $equipmentTypeId = $this->pageFilters['equipment_type_id'] ?? null;

        if (blank($equipmentTypeId)) {
            return null;
        }

        return (int) $equipmentTypeId;
    }

    protected function getSelectedCondition(): ?string
    {
        return $this->pageFilters['condition'] ?? null;
    }

    protected function applyFiltersToInventoryBuilder(Builder $query): void
    {
        $organizationId = $this->getSelectedOrganizationId();
        $organizationType = $this->getSelectedOrganizationType();
        $equipmentTypeId = $this->getSelectedEquipmentTypeId();
        $condition = $this->getSelectedCondition();

        $query
            ->when($organizationId, fn (Builder $builder) => $builder->where('organization_id', $organizationId))
            ->when($organizationType, fn (Builder $builder) => $builder->whereHas('organization', fn (Builder $organization) => $organization->where('type', $organizationType)))
            ->when($equipmentTypeId, fn (Builder $builder) => $builder->where('equipment_type_id', $equipmentTypeId))
            ->when($condition, fn (Builder $builder) => $builder->byCondition($condition));
    }

    protected function applyFiltersToSiteBuilder(Builder $query): void
    {
        $organizationId = $this->getSelectedOrganizationId();
        $organizationType = $this->getSelectedOrganizationType();

        $query
            ->when($organizationId, fn (Builder $builder) => $builder->where('organization_id', $organizationId))
            ->when($organizationType, fn (Builder $builder) => $builder->whereHas('organization', fn (Builder $organization) => $organization->where('type', $organizationType)));
    }

    protected function formatNumber(float|int|string|null $value): string
    {
        $numericValue = is_numeric($value) ? (float) $value : 0.0;

        return number_format($numericValue, 0, ',', '.');
    }

    protected function makeInventoryCategoryStats(Builder $baseQuery, Builder $siteQuery): array
    {
        $definitions = $this->getInventoryCategoryDefinitions();

        if (empty($definitions)) {
            return [];
        }

        $metrics = $this->calculateInventoryCategoryMetrics($baseQuery);
        
        // Tambahkan metrics untuk Tower/Site dari tabel sites
        $siteCount = $siteQuery->count();
        $metrics['TOWER'] = [
            'asset_count' => $siteCount,
            'total_units' => $siteCount,
        ];
        
        $stats = [];

        foreach ($definitions as $category => $definition) {
            $categoryMetrics = $metrics[$category] ?? [
                'asset_count' => 0,
                'total_units' => 0,
            ];

            $valueKey = $definition['value_key'] ?? 'total_units';
            $value = $categoryMetrics[$valueKey] ?? 0;

            $stat = Stat::make($definition['label'], $this->formatNumber($value))
                ->description($definition['description'] ?? 'Total untuk ' . $definition['label'])
                ->color($definition['color'] ?? 'primary');

            if (isset($definition['icon'])) {
                $stat->icon($definition['icon']);
            }

            if (isset($definition['description_icon'])) {
                $stat->descriptionIcon($definition['description_icon']);
            }

            if (isset($definition['description_color'])) {
                $stat->descriptionColor($definition['description_color']);
            }

            if (isset($definition['chart'])) {
                $stat->chart($definition['chart']);
            }

            if (isset($definition['chart_color'])) {
                $stat->chartColor($definition['chart_color']);
            }

            if (isset($definition['extra_attributes'])) {
                $stat->extraAttributes($definition['extra_attributes']);
            }

            $stats[] = $stat;
        }

        return $stats;
    }

    protected function calculateInventoryCategoryMetrics(Builder $baseQuery): array
    {
        $query = (clone $baseQuery)
            ->selectRaw('equipment_types.category as category')
            ->selectRaw('COUNT(inventories.id) as asset_count')
            ->selectRaw('COALESCE(SUM(inventories.quantity), 0) as total_units')
            ->join('equipment_types', 'equipment_types.id', '=', 'inventories.equipment_type_id')
            ->groupBy('equipment_types.category');

        return $query->get()
            ->mapWithKeys(fn ($row) => [
                $row->category => [
                    'asset_count' => (int) $row->asset_count,
                    'total_units' => (int) $row->total_units,
                ],
            ])
            ->all();
    }

    protected function getInventoryCategoryDefinitions(): array
    {
        return [
            'TOWER' => [
                'label' => 'Tower',
                'icon' => 'heroicon-m-adjustments-horizontal',
                'color' => 'info',
                'description' => 'Total untuk Tower',
                'extra_attributes' => [
                    'class' => 'bg-sky-50 ring-1 ring-sky-200 text-sky-900',
                ],
            ],
            'HT' => [
                'label' => 'HT',
                'icon' => 'heroicon-m-rss',
                'color' => 'success',
                'description' => 'Total untuk HT',
                'extra_attributes' => [
                    'class' => 'bg-emerald-50 ring-1 ring-emerald-200 text-emerald-900',
                ],
            ],
            'REPEATER' => [
                'label' => 'Repeater',
                'icon' => 'heroicon-m-arrow-path',
                'color' => 'warning',
                'description' => 'Total untuk Repeater',
                'extra_attributes' => [
                    'class' => 'bg-amber-50 ring-1 ring-amber-200 text-amber-900',
                ],
            ],
            'TRUNKING' => [
                'label' => 'Trunking',
                'icon' => 'heroicon-m-link',
                'color' => 'primary',
                'description' => 'Total untuk MSO / Trunking',
                'extra_attributes' => [
                    'class' => 'bg-primary-50 ring-1 ring-primary-200 text-primary-900',
                ],
            ],
            'RADIO MOBILE' => [
                'label' => 'Radio Mobile',
                'icon' => 'heroicon-m-signal',
                'color' => 'info',
                'description' => 'Total untuk Radio Mobile',
                'extra_attributes' => [
                    'class' => 'bg-blue-50 ring-1 ring-blue-200 text-blue-900',
                ],
            ],
            'RADIO FIXED' => [
                'label' => 'Radio Fixed',
                'icon' => 'heroicon-m-rectangle-stack',
                'color' => 'info',
                'description' => 'Total untuk Radio Fixed',
                'extra_attributes' => [
                    'class' => 'bg-indigo-50 ring-1 ring-indigo-200 text-indigo-900',
                ],
            ],
            'ANDROID' => [
                'label' => 'Android',
                'icon' => 'heroicon-m-device-phone-mobile',
                'color' => 'success',
                'description' => 'Total untuk Android',
                'extra_attributes' => [
                    'class' => 'bg-green-50 ring-1 ring-green-200 text-green-900',
                ],
            ],
            'ROUTER' => [
                'label' => 'Router',
                'icon' => 'heroicon-m-cpu-chip',
                'color' => 'info',
                'description' => 'Total untuk Router',
                'extra_attributes' => [
                    'class' => 'bg-cyan-50 ring-1 ring-cyan-200 text-cyan-900',
                ],
            ],
            'RGU' => [
                'label' => 'RGU',
                'icon' => 'heroicon-m-server-stack',
                'color' => 'gray',
                'description' => 'Total untuk RGU',
                'extra_attributes' => [
                    'class' => 'bg-slate-50 ring-1 ring-slate-200 text-slate-900',
                ],
            ],
            'SHELTER' => [
                'label' => 'Shelter',
                'icon' => 'heroicon-m-home-modern',
                'color' => 'purple',
                'description' => 'Total untuk Shelter',
                'extra_attributes' => [
                    'class' => 'bg-purple-50 ring-1 ring-purple-200 text-purple-900',
                ],
            ],
            'VEHICLE' => [
                'label' => 'Kendaraan TIK',
                'icon' => 'heroicon-m-truck',
                'color' => 'rose',
                'description' => 'Total untuk Kendaraan TIK',
                'extra_attributes' => [
                    'class' => 'bg-rose-50 ring-1 ring-rose-200 text-rose-900',
                ],
            ],
        ];
    }
}
