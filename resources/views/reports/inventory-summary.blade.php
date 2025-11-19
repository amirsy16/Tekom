<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Inventaris Summary - POLDA Jambi</title>
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
        .summary-box {
            background-color: #f9f9f9;
            border: 2px solid #333;
            padding: 15px;
            margin: 20px 0;
        }
        .condition-bb { background-color: #90EE90; }
        .condition-rr { background-color: #FFE4B5; }
        .condition-rb { background-color: #FFB6C1; }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9px;
        }
        .chart-bar {
            height: 20px;
            background-color: #4CAF50;
            text-align: center;
            line-height: 20px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN INVENTARIS SUMMARY</h1>
        <h2>POLDA JAMBI DAN JAJARAN</h2>
        <p>Periode: {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    </div>

    <!-- Summary Statistics -->
    <div class="summary-box">
        <h3 style="text-align: center; margin-top: 0;">RINGKASAN INVENTARIS</h3>
        <table style="margin-bottom: 10px;">
            <tr>
                <td class="text-left" style="width: 50%; font-weight: bold;">Total Aset Komunikasi:</td>
                <td style="font-size: 14px; font-weight: bold; color: #2196F3;">{{ number_format($data['total_assets']) }} Unit</td>
            </tr>
            <tr class="condition-bb">
                <td class="text-left" style="font-weight: bold;">Kondisi Baik (BB):</td>
                <td style="font-size: 12px; font-weight: bold;">{{ number_format($data['by_condition']['BB']) }} Unit ({{ $data['total_assets'] > 0 ? round(($data['by_condition']['BB'] / $data['total_assets']) * 100, 1) : 0 }}%)</td>
            </tr>
            <tr class="condition-rr">
                <td class="text-left" style="font-weight: bold;">Rusak Ringan (RR):</td>
                <td style="font-size: 12px; font-weight: bold;">{{ number_format($data['by_condition']['RR']) }} Unit ({{ $data['total_assets'] > 0 ? round(($data['by_condition']['RR'] / $data['total_assets']) * 100, 1) : 0 }}%)</td>
            </tr>
            <tr class="condition-rb">
                <td class="text-left" style="font-weight: bold;">Rusak Berat (RB):</td>
                <td style="font-size: 12px; font-weight: bold;">{{ number_format($data['by_condition']['RB']) }} Unit ({{ $data['total_assets'] > 0 ? round(($data['by_condition']['RB'] / $data['total_assets']) * 100, 1) : 0 }}%)</td>
            </tr>
        </table>
    </div>

    <!-- Distribution by Organization -->
    <h3>DISTRIBUSI ASET PER SATUAN KERJA</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Kode Satuan</th>
                <th style="width: 45%;">Nama Satuan Kerja</th>
                <th style="width: 15%;">Jenis Satuan</th>
                <th style="width: 10%;">Jumlah Aset</th>
                <th style="width: 10%;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data['by_organization'] as $org)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $org->code }}</td>
                    <td class="text-left">{{ $org->name }}</td>
                    <td>{{ $org->type }}</td>
                    <td style="font-weight: bold;">{{ number_format($org->inventories_count) }}</td>
                    <td>{{ $data['total_assets'] > 0 ? round(($org->inventories_count / $data['total_assets']) * 100, 1) : 0 }}%</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="font-weight: bold; background-color: #f0f0f0;">
                <td colspan="4">TOTAL</td>
                <td>{{ number_format($data['total_assets']) }}</td>
                <td>100%</td>
            </tr>
        </tfoot>
    </table>

    <!-- Distribution by Installation Year -->
    <h3>DISTRIBUSI ASET BERDASARKAN TAHUN INSTALASI</h3>
    <table>
        <thead>
            <tr>
                <th style="width: 10%;">No</th>
                <th style="width: 30%;">Tahun Instalasi</th>
                <th style="width: 30%;">Jumlah Aset</th>
                <th style="width: 30%;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($data['by_year'] as $year)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $year->installation_year }}</td>
                    <td style="font-weight: bold;">{{ number_format($year->count) }} Unit</td>
                    <td>{{ $data['total_assets'] > 0 ? round(($year->count / $data['total_assets']) * 100, 1) : 0 }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>Catatan:</strong></p>
        <ul style="text-align: left; font-size: 8px;">
            <li>BB = Baik (Berfungsi dengan baik)</li>
            <li>RR = Rusak Ringan (Perlu perbaikan minor)</li>
            <li>RB = Rusak Berat (Perlu penggantian/perbaikan mayor)</li>
        </ul>
        <br>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
        <p>POLDA JAMBI - Sistem Inventaris Komunikasi</p>
    </div>
</body>
</html>