<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Jenis Perangkat - POLDA Jambi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            padding: 10px 0;
        }
        .header h2 {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 5px 0;
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-left {
            text-align: left;
        }
        .category-header {
            background-color: #e6f3ff;
            font-weight: bold;
            font-size: 11px;
        }
        .equipment-row {
            background-color: #f9f9f9;
        }
        .detail-row {
            font-size: 9px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9px;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN BERDASARKAN JENIS PERANGKAT</h1>
        <h2>POLDA JAMBI DAN JAJARAN</h2>
        <p>Periode: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>

    @php 
        $categories = $data->groupBy('category');
        $totalEquipment = $data->sum('inventories_count');
    @endphp

    <!-- Summary by Category -->
    <h3>RINGKASAN PER KATEGORI PERANGKAT</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 30%;">Kategori</th>
                <th style="width: 30%;">Jumlah Jenis</th>
                <th style="width: 30%;">Total Unit</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($categories as $category => $equipments)
                <tr class="category-header">
                    <td>{{ $no++ }}</td>
                    <td>{{ $category }}</td>
                    <td>{{ $equipments->count() }} Jenis</td>
                    <td>{{ number_format($equipments->sum('inventories_count')) }} Unit</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="font-weight: bold; background-color: #d4edda;">
                <td colspan="2">TOTAL</td>
                <td>{{ $data->count() }} Jenis</td>
                <td>{{ number_format($totalEquipment) }} Unit</td>
            </tr>
        </tfoot>
    </table>

    <!-- Detail by Equipment Type -->
    <h3 style="page-break-before: always;">DETAIL JENIS PERANGKAT</h3>
    
    @foreach($categories as $category => $equipments)
        <h4 style="background-color: #e6f3ff; padding: 8px; margin: 20px 0 10px 0; border: 1px solid #000;">
            KATEGORI: {{ strtoupper($category) }} ({{ $equipments->sum('inventories_count') }} Unit)
        </h4>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Nama Perangkat</th>
                    <th style="width: 15%;">Brand</th>
                    <th style="width: 10%;">Total Unit</th>
                    <th style="width: 45%;">Lokasi Sebaran</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach($equipments as $equipment)
                    <tr class="equipment-row">
                        <td>{{ $no++ }}</td>
                        <td class="text-left"><strong>{{ $equipment->name }}</strong></td>
                        <td>{{ $equipment->brand }}</td>
                        <td style="font-weight: bold; font-size: 11px;">{{ number_format($equipment->inventories_count) }}</td>
                        <td class="text-left">
                            @php
                                $locations = $equipment->inventories->groupBy('organization.name')->map(function($items) {
                                    return $items->count();
                                });
                            @endphp
                            @foreach($locations as $orgName => $count)
                                <div style="font-size: 8px;">• {{ $orgName }}: {{ $count }} unit</div>
                            @endforeach
                        </td>
                    </tr>
                    
                    <!-- Detail per lokasi -->
                    @if($equipment->inventories->count() > 0)
                        @foreach($equipment->inventories->groupBy('site.name') as $siteName => $siteInventories)
                            <tr class="detail-row">
                                <td></td>
                                <td class="text-left" style="padding-left: 20px;">└ {{ $siteName }}</td>
                                <td>-</td>
                                <td>{{ $siteInventories->count() }}</td>
                                <td class="text-left">
                                    @php
                                        $conditions = $siteInventories->groupBy('condition');
                                    @endphp
                                    BB: {{ $conditions->get('BB', collect())->count() }}, 
                                    RR: {{ $conditions->get('RR', collect())->count() }}, 
                                    RB: {{ $conditions->get('RB', collect())->count() }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="footer">
        <p><strong>Catatan:</strong></p>
        <ul style="text-align: left; font-size: 8px;">
            <li>BB = Baik (Berfungsi dengan baik)</li>
            <li>RR = Rusak Ringan (Perlu perbaikan minor)</li>
            <li>RB = Rusak Berat (Perlu penggantian/perbaikan mayor)</li>
            <li>Data menampilkan sebaran perangkat per lokasi dan kondisinya</li>
        </ul>
        <br>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <p>POLDA JAMBI - Sistem Inventaris Komunikasi</p>
    </div>
</body>
</html>