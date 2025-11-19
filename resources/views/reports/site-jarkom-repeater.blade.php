<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Site Jarkom Repeater - POLDA Jambi</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0.5cm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 0;
            padding: 0;
            line-height: 1.2;
            /* Optimize for PDF generation */
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 14px;
            font-weight: bold;
            margin: 3px 0;
            text-decoration: underline;
        }
        .logo-container {
            position: relative;
            height: 80px;
            margin: 10px 0;
        }
        .logo {
            position: absolute;
            right: 0;
            top: -60px;
            width: 80px;
            height: 80px;
            border: 1px solid #ccc;
            text-align: center;
            line-height: 80px;
            font-size: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            font-size: 9px;
        }
        th, td {
            border: 1px solid #000;
            padding: 2px 4px;
            text-align: center;
            vertical-align: middle;
            font-size: 9px;
            height: 20px;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 8px;
        }
        .col-no { width: 5%; }
        .col-satker { width: 12%; }
        .col-nama-alkom { width: 15%; }
        .col-band-frek { width: 10%; }
        .col-vol { width: 8%; }
        .col-sat { width: 8%; }
        .col-tahun { width: 8%; }
        .col-bb { width: 6%; }
        .col-rr { width: 6%; }
        .col-rb { width: 6%; }
        .col-ket { width: 16%; }
        
        .satker-header {
            font-weight: bold;
            text-align: left;
            background-color: #ffffff;
            font-size: 9px;
        }
        .jml-row {
            background-color: #ffff00 !important;
            font-weight: bold;
            text-align: center;
            font-size: 9px;
        }
        .text-left {
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .equipment-row {
            font-size: 9px;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
        }
        .page-number {
            position: fixed;
            bottom: 1cm;
            right: 1cm;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <div class="logo">LOGO POLRI</div>
        </div>
        <h1>DATA SITE JARKOM REPEATER</h1>
        <h1>POLDA JAMBI DAN JAJARAN {{ $data['period']['formatted'] ?? 'S/D BULAN AGUSTUS 2025' }}</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2" class="col-no">NO</th>
                <th rowspan="2" class="col-nama-alkom">SATWIL<br><br>NAMA SITE</th>
                <th colspan="4">STATUS SITE / TOWER</th>
                <th rowspan="2" class="col-band-frek">JENIS<br>REPEATER /<br>PERANGKAT<br>EXISTING</th>
                <th rowspan="2" class="col-tahun">TAH<br>UN</th>
                <th rowspan="2" class="col-vol">VOL</th>
                <th rowspan="2" class="col-sat">SAT</th>
                <th colspan="3">KONDISI</th>
                <th rowspan="2" class="col-ket">KET</th>
            </tr>
            <tr>
                <th class="col-satker">POLRI</th>
                <th class="col-satker">TELKO<br>M</th>
                <th class="col-satker">TVRI</th>
                <th class="col-satker">INDOS<br>AT</th>
                <th class="col-bb">BB</th>
                <th class="col-rr">RR</th>
                <th class="col-rb">RB</th>
            </tr>
            <tr style="font-size: 7px; background-color: #f0f0f0;">
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
            </tr>
        </thead>
        <tbody>
            @php
                $orgIndex = 1;
            @endphp
            @forelse ($data['organizations'] as $organization)
                <tr>
                    <td class="jml-row">{{ $orgIndex }}.</td>
                    <td class="jml-row text-left" style="padding-left: 5px;">{{ strtoupper($organization['organization']) }}</td>
                    <td class="jml-row">{{ $organization['status_totals']['POLRI'] ?: '-' }}</td>
                    <td class="jml-row">{{ $organization['status_totals']['TELKOM'] ?: '-' }}</td>
                    <td class="jml-row">{{ $organization['status_totals']['TVRI'] ?: '-' }}</td>
                    <td class="jml-row">{{ $organization['status_totals']['INDOSAT'] ?: '-' }}</td>
                    <td class="jml-row">-</td>
                    <td class="jml-row">-</td>
                    <td class="jml-row">{{ $organization['tower_count'] }}</td>
                    <td class="jml-row">Unit</td>
                    <td class="jml-row">{{ $organization['condition_totals']['bb'] ?: '-' }}</td>
                    <td class="jml-row">{{ $organization['condition_totals']['rr'] ?: '-' }}</td>
                    <td class="jml-row">{{ $organization['condition_totals']['rb'] ?: '-' }}</td>
                    <td class="jml-row"></td>
                </tr>

                @php $siteIndex = 'a'; @endphp
                @foreach ($organization['sites'] as $site)
                    <tr>
                        <td>{{ $siteIndex }}.</td>
                        <td class="satker-header text-left">
                            {{ $site['name'] }}<br>
                            <span style="font-size: 7px; color: #555;">{{ $site['location'] ?? '' }} {{ $site['tower_height'] ? 'SST ' . $site['tower_height'] : '' }}</span>
                        </td>
                        <td>{{ $site['status_counts']['POLRI'] ? 'POLRI' : '-' }}</td>
                        <td>{{ $site['status_counts']['TELKOM'] ? 'TELKOM' : '-' }}</td>
                        <td>{{ $site['status_counts']['TVRI'] ? 'TVRI' : '-' }}</td>
                        <td>{{ $site['status_counts']['INDOSAT'] ? 'INDOSAT' : '-' }}</td>
                        <td>REPEATER</td>
                        <td>-</td>
                        <td>{{ $site['volume'] }}</td>
                        <td>Unit</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="font-size: 7px;"></td>
                    </tr>

                    @foreach ($site['towers'] as $tower)
                        <tr class="equipment-row">
                            <td></td>
                            <td class="text-left" style="padding-left: 15px;">- {{ $tower['user'] ?? $tower['repeater_type'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $tower['repeater_type'] }}</td>
                            <td>{{ $tower['year'] }}</td>
                            <td>1</td>
                            <td>Unit</td>
                            <td>{{ $tower['condition_bb'] ?: '-' }}</td>
                            <td>{{ $tower['condition_rr'] ?: '-' }}</td>
                            <td>{{ $tower['condition_rb'] ?: '-' }}</td>
                            <td class="text-left" style="font-size: 7px;">{{ $tower['notes'] }}</td>
                        </tr>
                    @endforeach

                    @php $siteIndex++; @endphp
                @endforeach

                @php
                    $orgIndex++;
                @endphp
            @empty
                <tr>
                    <td colspan="14" style="text-align: center; padding: 20px;">Tidak ada data tower tersedia.</td>
                </tr>
            @endforelse

            @if (!empty($data['organizations']))
                <tr class="jml-row">
                    <td colspan="2"><strong>JUMLAH</strong></td>
                    <td><strong>{{ $data['totals']['status']['POLRI'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['status']['TELKOM'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['status']['TVRI'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['status']['INDOSAT'] ?? '-' }}</strong></td>
                    <td><strong>RPT + KOMOB + LINK</strong></td>
                    <td></td>
                    <td><strong>{{ $data['totals']['towers'] ?? '-' }}</strong></td>
                    <td><strong>Unit</strong></td>
                    <td><strong>{{ $data['totals']['condition']['bb'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['condition']['rr'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['condition']['rb'] ?? '-' }}</strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>KOMOB RPT</strong></td>
                    <td></td>
                    <td><strong>{{ $data['totals']['komob'] ?? '-' }}</strong></td>
                    <td><strong>Unit</strong></td>
                    <td><strong>{{ $data['totals']['komob_bb'] ?? '-' }}</strong></td>
                    <td><strong>-</strong></td>
                    <td><strong>-</strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><strong>JUMLAH</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>LINK</strong></td>
                    <td></td>
                    <td><strong>{{ $data['totals']['link'] ?? '-' }}</strong></td>
                    <td><strong>Unit</strong></td>
                    <td><strong>{{ $data['totals']['link_bb'] ?? '-' }}</strong></td>
                    <td><strong>-</strong></td>
                    <td><strong>{{ $data['totals']['link_rb'] ?? '-' }}</strong></td>
                    <td></td>
                </tr>
                <tr class="jml-row">
                    <td colspan="2"><strong>JUMLAH</strong></td>
                    <td><strong>{{ $data['totals']['status']['POLRI'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['status']['TELKOM'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['status']['TVRI'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['status']['INDOSAT'] ?? '-' }}</strong></td>
                    <td><strong>REPEATER</strong></td>
                    <td></td>
                    <td><strong>{{ $data['totals']['towers'] ?? '-' }}</strong></td>
                    <td><strong>Unit</strong></td>
                    <td><strong>{{ $data['totals']['condition']['bb'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['condition']['rr'] ?? '-' }}</strong></td>
                    <td><strong>{{ $data['totals']['condition']['rb'] ?? '-' }}</strong></td>
                    <td></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="page-number">2</div>
</body>
</html>