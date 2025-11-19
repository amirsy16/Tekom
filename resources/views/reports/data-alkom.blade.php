<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data ALKOM POLDA Jambi dan Jajaran S/D Agustus 2025</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 1cm 0.8cm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 8px;
            margin: 0;
            padding: 0;
            line-height: 1.3;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
            text-decoration: underline;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
        }
        th, td {
            border: 1px solid #000;
            padding: 3px 4px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            font-weight: bold;
            font-size: 7px;
            background-color: #ffffff;
        }
        
        /* Column widths */
        .col-no { width: 3%; }
        .col-satker { width: 12%; }
        .col-nama-alkom { width: 15%; }
        .col-band-frek { width: 10%; }
        .col-vol { width: 6%; }
        .col-sat { width: 6%; }
        .col-tahun { width: 7%; }
        .col-bb { width: 5%; }
        .col-rr { width: 5%; }
        .col-rb { width: 5%; }
        .col-ket { width: 20%; }
        
        /* Special rows */
        .satker-name {
            font-weight: bold;
            text-align: left;
            padding-left: 5px;
        }
        .category-letter {
            font-weight: normal;
            text-align: left;
            padding-left: 8px;
        }
        .jml-row {
            background-color: #FFFF00 !important;
            font-weight: bold;
        }
        .text-left {
            text-align: left;
            padding-left: 5px;
        }
        .page-number {
            position: fixed;
            bottom: 0.5cm;
            right: 0.8cm;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>DATA ALAT KOMUNIKASI</h1>
        <h1>POLDA JAMBI DAN JAJARAN {{ $period['formatted'] ?? 'S/D BULAN AGUSTUS 2025' }}</h1>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="3" class="col-no">NO</th>
                <th rowspan="3" class="col-satker">NAMA SATKER</th>
                <th colspan="2" rowspan="2">JENIS AKOM</th>
                <th rowspan="3" class="col-vol">VOL</th>
                <th rowspan="3" class="col-sat">SAT</th>
                <th rowspan="3" class="col-tahun">TAH<br>UN</th>
                <th colspan="3" rowspan="2">KONDISI</th>
                <th rowspan="3" class="col-ket">KET</th>
            </tr>
            <tr>
            </tr>
            <tr>
                <th class="col-nama-alkom">NAMA ALKOM</th>
                <th class="col-band-frek">BAND FREK</th>
                <th class="col-bb">BB</th>
                <th class="col-rr">RR</th>
                <th class="col-rb">RB</th>
            </tr>
            <tr style="font-size: 7px;">
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
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
            @if(isset($organizations) && is_iterable($organizations))
                @foreach($organizations as $satker)
                    @if(isset($satker['equipment']) && is_iterable($satker['equipment']) && count($satker['equipment']) > 0)
                        @php 
                            $totalRows = count($satker['equipment']) * 2; // Each category has header + JML
                        @endphp
                        
                        @php 
                            $firstCategory = true;
                            $categoryLetters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];
                            $letterIndex = 0;
                        @endphp
                        
                        @foreach($satker['equipment'] as $category)
                            {{-- Category Header Row --}}
                            <tr>
                                @if($firstCategory)
                                    <td rowspan="{{ $totalRows }}" class="satker-name">{{ $counter }}.</td>
                                    <td rowspan="{{ $totalRows }}" class="satker-name">{{ strtoupper($satker['name'] ?? '') }}</td>
                                @endif
                                <td class="text-left">{{ $categoryLetters[$letterIndex] ?? '' }}. {{ strtoupper($category['name'] ?? '') }}</td>
                                <td>{{ $category['frequency'] ?? '800 MHz' }}</td>
                                <td>{{ $category['volume'] ?? '-' }}</td>
                                <td>UNIT</td>
                                <td>{{ $category['year'] ?? '-' }}</td>
                                <td>{{ $category['bb'] ?? '-' }}</td>
                                <td>{{ $category['rr'] ?? '-' }}</td>
                                <td>{{ $category['rb'] ?? '-' }}</td>
                                <td class="text-left">{{ $category['notes'] ?? '' }}</td>
                            </tr>
                            
                            {{-- JML Row --}}
                            <tr class="jml-row">
                                <td><strong>JML</strong></td>
                                <td></td>
                                <td><strong>{{ $category['total_volume'] ?? ($category['volume'] ?? '-') }}</strong></td>
                                <td><strong>UNIT</strong></td>
                                <td></td>
                                <td><strong>{{ $category['total_bb'] ?? ($category['bb'] ?? '-') }}</strong></td>
                                <td><strong>{{ $category['total_rr'] ?? ($category['rr'] ?? '-') }}</strong></td>
                                <td><strong>{{ $category['total_rb'] ?? ($category['rb'] ?? '-') }}</strong></td>
                                <td></td>
                            </tr>
                            
                            @php 
                                $firstCategory = false;
                                $letterIndex++;
                            @endphp
                        @endforeach
                        @php $counter++; @endphp
                    @endif
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="page-number">{{ $pageNumber ?? 11 }}</div>
</body>
</html>