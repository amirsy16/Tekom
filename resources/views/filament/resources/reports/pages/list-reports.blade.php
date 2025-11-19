<x-filament-panels::page>
    <div class="space-y-6">
        
        <!-- Page Header -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                    <x-heroicon-o-document-text class="w-7 h-7 text-white" />
                </div>
                <div>
                    <h2 class="text-2xl font-bold">Sistem Pelaporan</h2>
                    <p class="text-blue-100 text-sm mt-1">Generate laporan inventaris dalam format PDF atau DOCX</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 p-4 border-b border-indigo-200">
                <div class="flex items-center">
                    <x-heroicon-o-calendar class="w-6 h-6 text-indigo-700 mr-3" />
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Periode Laporan</h3>
                        <p class="text-sm text-indigo-700">Pilih bulan dan tahun untuk header laporan</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bulan</label>
                        <select wire:model="selectedMonth" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <select wire:model="selectedYear" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @php
                                $currentYear = (int) now()->format('Y');
                                for ($i = $currentYear; $i >= $currentYear - 10; $i--) {
                                    echo "<option value='{$i}'>{$i}</option>";
                                }
                            @endphp
                        </select>
                    </div>
                </div>
                
                <div class="mt-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-start">
                        <x-heroicon-o-information-circle class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0 mt-0.5" />
                        <p class="text-sm text-blue-800">
                            <strong>Catatan:</strong> Periode ini hanya untuk ditampilkan di header laporan sebagai "POLDA JAMBI DAN JAJARAN S/D BULAN [BULAN] [TAHUN]". Semua data inventaris akan tetap ditampilkan secara lengkap.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Generation Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Site Jarkom Card -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                <div class="bg-gradient-to-r from-green-50 to-green-100 p-4 border-b border-green-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                            <x-heroicon-o-map-pin class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Site Jarkom Repeater</h3>
                            <p class="text-sm text-green-700">Data lengkap site komunikasi</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-6">
                        Laporan lengkap data site komunikasi dan repeater dengan format tabel sesuai standar kepolisian. Tersedia dalam format landscape PDF dan DOCX.
                    </p>
                    <div class="grid grid-cols-2 gap-3">
                        <button 
                            wire:click="generateSiteJarkomReport"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center shadow-sm">
                            <x-heroicon-o-document class="w-4 h-4 mr-2" />
                            PDF
                        </button>
                        <button 
                            wire:click="generateSiteJarkomReportDocx"
                            class="w-full bg-white hover:bg-green-50 text-green-700 border-2 border-green-600 font-medium py-2.5 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <x-heroicon-o-document-text class="w-4 h-4 mr-2" />
                            DOCX
                        </button>
                    </div>
                </div>
            </div>

            <!-- Data ALKOM Card -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                <div class="bg-gradient-to-r from-cyan-50 to-cyan-100 p-4 border-b border-cyan-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-cyan-600 rounded-lg flex items-center justify-center mr-3">
                            <x-heroicon-o-radio class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Data ALKOM</h3>
                            <p class="text-sm text-cyan-700">Alat komunikasi per satuan</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-6">
                        Laporan data alat komunikasi (ALKOM) meliputi Repeater, Radio Fixed/Mobile, HT, Android, Router, dan RGU. Format portrait A4 dengan breakdown per satker.
                    </p>
                    <div class="grid grid-cols-2 gap-3">
                        <button 
                            wire:click="generateDataAlkomReport"
                            class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-medium py-2.5 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center shadow-sm">
                            <x-heroicon-o-document class="w-4 h-4 mr-2" />
                            PDF
                        </button>
                        <button 
                            wire:click="generateDataAlkomReportDocx"
                            class="w-full bg-white hover:bg-cyan-50 text-cyan-700 border-2 border-cyan-600 font-medium py-2.5 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <x-heroicon-o-document-text class="w-4 h-4 mr-2" />
                            DOCX
                        </button>
                    </div>
                </div>
            </div>

            <!-- Inventory Summary Card -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 border-b border-blue-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                            <x-heroicon-o-chart-bar class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Inventaris Summary</h3>
                            <p class="text-sm text-blue-700">Ringkasan kondisi aset</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-6">
                        Laporan ringkasan inventaris dengan statistik kondisi perangkat (BB/RR/RB) dan distribusi aset per satuan kerja dalam format portrait.
                    </p>
                    <button 
                        wire:click="generateInventoryReport"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center shadow-sm">
                        <x-heroicon-o-arrow-down-tray class="w-4 h-4 mr-2" />
                        Generate PDF
                    </button>
                </div>
            </div>

            <!-- Equipment Type Card -->
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                <div class="bg-gradient-to-r from-amber-50 to-amber-100 p-4 border-b border-amber-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-12 h-12 bg-amber-600 rounded-lg flex items-center justify-center mr-3">
                            <x-heroicon-o-cpu-chip class="w-6 h-6 text-white" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Jenis Perangkat</h3>
                            <p class="text-sm text-amber-700">Laporan per kategori</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-600 mb-6">
                        Laporan terperinci berdasarkan kategori perangkat seperti Repeater, HT, Trunking, Android, Router, dan perangkat lainnya.
                    </p>
                    <button 
                        wire:click="generateEquipmentTypeReport"
                        class="w-full bg-amber-600 hover:bg-amber-700 text-white font-medium py-2.5 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center shadow-sm">
                        <x-heroicon-o-arrow-down-tray class="w-4 h-4 mr-2" />
                        Generate PDF
                    </button>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200">
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-4 border-b border-gray-200">
                <div class="flex items-center">
                    <x-heroicon-o-chart-pie class="w-6 h-6 text-gray-700 mr-3" />
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Ringkasan Data Sistem</h3>
                        <p class="text-sm text-gray-600">Overview statistik inventaris alat komunikasi</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center p-5 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl border-2 border-blue-200 hover:shadow-md transition-shadow">
                        <div class="text-4xl font-bold text-blue-600 mb-2">{{ \App\Models\Inventory::active()->count() }}</div>
                        <div class="text-sm font-medium text-gray-700">Total Aset</div>
                    </div>
                    
                    <div class="text-center p-5 bg-gradient-to-br from-green-50 to-green-100 rounded-xl border-2 border-green-200 hover:shadow-md transition-shadow">
                        <div class="text-4xl font-bold text-green-600 mb-2">{{ \App\Models\Organization::active()->count() }}</div>
                        <div class="text-sm font-medium text-gray-700">Satuan Kerja</div>
                    </div>
                    
                    <div class="text-center p-5 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl border-2 border-purple-200 hover:shadow-md transition-shadow">
                        <div class="text-4xl font-bold text-purple-600 mb-2">{{ \App\Models\Site::active()->count() }}</div>
                        <div class="text-sm font-medium text-gray-700">Total Site</div>
                    </div>
                    
                    <div class="text-center p-5 bg-gradient-to-br from-amber-50 to-amber-100 rounded-xl border-2 border-amber-200 hover:shadow-md transition-shadow">
                        <div class="text-4xl font-bold text-amber-600 mb-2">{{ \App\Models\EquipmentType::active()->count() }}</div>
                        <div class="text-sm font-medium text-gray-700">Jenis Perangkat</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Format Guide -->
        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg p-6 border border-indigo-200">
            <div class="flex items-start">
                <div class="flex-shrink-0 w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center mr-4">
                    <x-heroicon-o-information-circle class="w-6 h-6 text-white" />
                </div>
                <div class="flex-1">
                    <h4 class="text-base font-bold text-gray-900 mb-2">Panduan Format Laporan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="flex items-start space-x-2">
                            <span class="flex-shrink-0 w-2 h-2 bg-green-500 rounded-full mt-1.5"></span>
                            <div>
                                <span class="font-semibold text-gray-800">PDF:</span>
                                <span class="text-gray-600"> Format standar untuk cetak dan arsip resmi</span>
                            </div>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="flex-shrink-0 w-2 h-2 bg-blue-500 rounded-full mt-1.5"></span>
                            <div>
                                <span class="font-semibold text-gray-800">DOCX:</span>
                                <span class="text-gray-600"> Format editable untuk modifikasi lanjutan</span>
                            </div>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="flex-shrink-0 w-2 h-2 bg-purple-500 rounded-full mt-1.5"></span>
                            <div>
                                <span class="font-semibold text-gray-800">Landscape:</span>
                                <span class="text-gray-600"> Site Jarkom (tabel lebar)</span>
                            </div>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span class="flex-shrink-0 w-2 h-2 bg-amber-500 rounded-full mt-1.5"></span>
                            <div>
                                <span class="font-semibold text-gray-800">Portrait:</span>
                                <span class="text-gray-600"> Data ALKOM, Summary, Jenis Perangkat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>