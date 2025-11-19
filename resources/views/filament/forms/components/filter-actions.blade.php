<div class="col-span-full">
    <div class="flex flex-wrap gap-3 justify-start md:justify-center items-center mt-2">
        <x-filament::button
            wire:click="applyFilters"
            color="primary"
            icon="heroicon-m-funnel"
            size="md"
        >
            Terapkan Filter
        </x-filament::button>

        <x-filament::button
            wire:click="resetFilters"
            color="gray"
            icon="heroicon-m-x-circle"
            outlined
            size="md"
        >
            Reset
        </x-filament::button>
    </div>
</div>
