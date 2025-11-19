<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-3">
                <x-filament::icon
                    icon="heroicon-o-information-circle"
                    class="h-6 w-6 text-primary-500"
                />
                <span>Panduan Format Laporan</span>
            </div>
        </x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Site Jarkom Repeater -->
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-success-500"></div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Site Jarkom Repeater</h4>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-4">
                    Laporan lengkap data site komunikasi dengan format <strong>Landscape A4</strong>. 
                    Tersedia dalam <strong>PDF</strong> (untuk cetak) dan <strong>DOCX</strong> (untuk edit).
                </p>
            </div>

            <!-- Data ALKOM -->
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-info-500"></div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Data ALKOM</h4>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-4">
                    Data alat komunikasi per satker (Repeater, HT, Radio, dll) dengan format <strong>Portrait A4</strong>. 
                    Tersedia dalam <strong>PDF</strong> dan <strong>DOCX</strong>.
                </p>
            </div>

            <!-- Inventaris Summary -->
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-primary-500"></div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Inventaris Summary</h4>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-4">
                    Ringkasan statistik kondisi perangkat (BB/RR/RB) dengan format <strong>Portrait PDF</strong>.
                </p>
            </div>

            <!-- Jenis Perangkat -->
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-warning-500"></div>
                    <h4 class="font-semibold text-gray-900 dark:text-white">Jenis Perangkat</h4>
                </div>
                <p class="text-sm text-gray-600 dark:text-gray-400 ml-4">
                    Laporan per kategori perangkat dengan format <strong>Portrait PDF</strong>.
                </p>
            </div>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-start gap-3 text-sm text-gray-600 dark:text-gray-400">
                <x-filament::icon
                    icon="heroicon-o-light-bulb"
                    class="h-5 w-5 text-warning-500 flex-shrink-0 mt-0.5"
                />
                <div>
                    <strong class="text-gray-900 dark:text-white">Tips:</strong> 
                    Gunakan format <strong>PDF</strong> untuk keperluan cetak dan arsip resmi. 
                    Gunakan format <strong>DOCX</strong> jika Anda perlu melakukan editing atau modifikasi lanjutan.
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
