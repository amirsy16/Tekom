<?php

namespace App\Filament\Pages;

use App\Models\Organization;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ViewField;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Schemas\Schema;

class Dashboard extends BaseDashboard
{
    /**
     * @var array<string, mixed>
     */
    public array $filters = [
        'organization_id' => null,
        'organization_type' => null,
        'condition' => null,
        'equipment_type_id' => null,
    ];

    protected $listeners = [
        'dashboard-filters.apply' => 'applyFiltersFromWidget',
    ];

    public function mount(): void
    {
        $this->filters = $this->mergeWithDefaultFilters($this->filters);

        $this->dispatchFiltersSynced();
    }

    protected function getFiltersForm(): Schema
    {
        return $this->filtersForm($this->makeSchema());
    }

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('organization_id')
                    ->label('Satuan Kerja')
                    ->placeholder('Semua Satuan Kerja')
                    ->options(fn () => Organization::active()->orderBy('name')->pluck('name', 'id')->all())
                    ->searchable()
                    ->preload()
                    ->native(false)
                    ->live(false), // Disable auto-update
                ViewField::make('filter_actions')
                    ->view('filament.forms.components.filter-actions')
                    ->columnSpanFull(),
            ])
            ->statePath('filters')
            ->columns([
                'default' => 1,
                '@md' => 2,
                '@xl' => 4,
            ])
            ->extraAttributes([
                'class' => 'gap-4 mb-6',
            ]);
    }

    public function applyFilters(): void
    {
        $this->dispatchFiltersSynced();
    }

    public function resetFilters(): void
    {
        $this->filters = $this->mergeWithDefaultFilters([]);
        $this->dispatchFiltersSynced();
    }

    public function applyFiltersFromWidget(array $filters): void
    {
        $this->filters = $this->mergeWithDefaultFilters($filters);

        $this->dispatchFiltersSynced();
    }

    protected function dispatchFiltersSynced(): void
    {
        $this->dispatch('dashboard-filters.synced', filters: $this->filters);
    }

    protected function mergeWithDefaultFilters(array $filters): array
    {
        return array_merge([
            'organization_id' => null,
            'organization_type' => null,
            'condition' => null,
            'equipment_type_id' => null,
        ], $filters);
    }
}
