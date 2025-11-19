<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Tower;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiteTowerSeeder extends Seeder
{
    public function run(): void
    {
        $records = $this->parseCsv($this->dataset());

        DB::transaction(function () use ($records) {
            Tower::query()->delete();
            Site::query()->delete();

            foreach ($records as $siteData) {
                $site = Site::create([
                    'name' => $siteData['name'],
                    'region' => $siteData['region'],
                    'location' => $siteData['location'],
                    'ownership' => $siteData['ownership'],
                    'tower_height' => null,
                    'latitude' => $siteData['latitude'],
                    'longitude' => $siteData['longitude'],
                    'description' => $siteData['description'],
                    'is_active' => true,
                ]);

                foreach ($siteData['towers'] as $towerData) {
                    $site->towers()->create($towerData);
                }
            }
        });
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function parseCsv(string $csv): array
    {
        $lines = preg_split("/\r\n|\r|\n/", $csv) ?: [];
        $sites = [];
        $currentRegion = null;
        $currentKey = null;

        foreach ($lines as $line) {
            $columns = array_map('trim', str_getcsv($line, ';'));

            if ($this->isHeaderRow($columns)) {
                continue;
            }

            if ($this->isRegionRow($columns)) {
                $currentRegion = $columns[1] ?: $currentRegion;
                $currentKey = null;
                continue;
            }

            if ($this->isSiteRow($columns)) {
                $rawName = $columns[1];
                if ($rawName === '' || $rawName === 'POLSEK .....') {
                    continue;
                }

                $currentKey = $this->siteKey($currentRegion, $rawName);

                if (! isset($sites[$currentKey])) {
                    $sites[$currentKey] = [
                        'raw_name' => $rawName,
                        'name' => $this->formatSiteName($rawName),
                        'region' => $this->formatRegion($currentRegion),
                        'location' => $columns[2] ?? null,
                        'ownership' => $columns[7] ?: null,
                        'latitude' => $this->parseCoordinate($columns[2] ?? null),
                        'longitude' => null,
                        'description_parts' => array_filter([
                            $this->formatRegion($currentRegion),
                            $columns[2] ?? null,
                        ]),
                        'towers' => [],
                    ];
                }

                $tower = $this->buildTowerData($columns);
                if ($tower) {
                    $sites[$currentKey]['towers'][] = $tower;
                }

                if (empty($sites[$currentKey]['ownership']) && ! empty($tower['site_status'])) {
                    $sites[$currentKey]['ownership'] = $tower['site_status'];
                }

                if (! empty($columns[15])) {
                    $sites[$currentKey]['description_parts'][] = $columns[15];
                }

                continue;
            }

            if ($currentKey && $this->isTowerRow($columns)) {
                $tower = $this->buildTowerData($columns);
                if ($tower) {
                    $sites[$currentKey]['towers'][] = $tower;
                }

                if (empty($sites[$currentKey]['ownership']) && ! empty($tower['site_status'])) {
                    $sites[$currentKey]['ownership'] = $tower['site_status'];
                }

                continue;
            }

            if ($currentKey && $this->isCoordinateSupplementRow($columns)) {
                $site =& $sites[$currentKey];

                foreach ([0, 1, 2, 3] as $index) {
                    if (! array_key_exists($index, $columns)) {
                        continue;
                    }

                    if ($this->looksLikeCoordinate($columns[$index])) {
                        $value = $this->parseCoordinate($columns[$index]);

                        if (is_null($value)) {
                            continue;
                        }

                        if (is_null($site['latitude']) && $this->isLatitude($columns[$index])) {
                            $site['latitude'] = $value;
                        }

                        if (is_null($site['longitude']) && $this->isLongitude($columns[$index])) {
                            $site['longitude'] = $value;
                        }
                    }
                }

                $snippet = implode(' ', array_filter($columns));
                if ($snippet !== '') {
                    $site['description_parts'][] = $snippet;
                }
            }
        }

        return $this->finaliseSites($sites);
    }

    protected function finaliseSites(array $sites): array
    {
        return array_values(array_map(function (array $site) {
            if (empty($site['ownership'])) {
                $site['ownership'] = 'LAINNYA';
            }

            $site['description_parts'] = array_unique(array_filter($site['description_parts']));
            $site['description'] = implode(' | ', $site['description_parts']);
            unset($site['description_parts']);

            if (is_null($site['latitude']) && $match = $this->extractFirstCoordinate($site['description'])) {
                $site['latitude'] = $match['lat'];
                $site['longitude'] = $site['longitude'] ?? $match['lon'];
            }

            if (is_null($site['latitude'])) {
                $site['latitude'] = null;
            }

            if (is_null($site['longitude'])) {
                $site['longitude'] = null;
            }

            return $site;
        }, $sites));
    }

    protected function extractFirstCoordinate(string $text): ?array
    {
        if (preg_match_all('/([NS]\s*\d+[^,;\|]*)|([EW]\s*\d+[^,;\|]*)/', $text, $matches)) {
            $coords = array_filter(array_map(fn ($value) => $this->parseCoordinate($value), $matches[0]));
            if (count($coords) >= 2) {
                return ['lat' => array_values($coords)[0], 'lon' => array_values($coords)[1]];
            }
        }

        return null;
    }

    protected function buildTowerData(array $columns): ?array
    {
        $repeaterType = $columns[3] ?? null;
        $system = $columns[4] ?? null;
        $frequencyRx = $columns[5] ?? null;
        $frequencyTx = $columns[6] ?? null;

        if ($repeaterType === '' && $system === '' && $frequencyRx === '' && $frequencyTx === '') {
            return null;
        }

        return [
            'repeater_type' => $repeaterType ?: null,
            'system' => $this->normaliseSystem($system),
            'frequency_rx' => $this->sanitiseFrequency($frequencyRx),
            'frequency_tx' => $this->sanitiseFrequency($frequencyTx),
            'site_status' => $columns[7] ?: null,
            'tower_structure' => $columns[8] ?: null,
            'tower_height' => $columns[9] ?: null,
            'condition_bb' => $this->normaliseCondition($columns[10] ?? null),
            'condition_rr' => $this->normaliseCondition($columns[11] ?? null),
            'condition_rb' => $this->normaliseCondition($columns[12] ?? null),
            'documentation' => $columns[13] ?: null,
            'user' => $columns[14] ?: null,
            'notes' => $columns[15] ?: null,
        ];
    }

    protected function normaliseCondition(?string $value): ?int
    {
        $value = trim((string) $value);
        if ($value === '' || $value === '-' || $value === '--') {
            return null;
        }

        return (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    protected function normaliseSystem(?string $value): ?string
    {
        $value = strtoupper(trim((string) $value));

        return $value !== '' ? $value : null;
    }

    protected function sanitiseFrequency(?string $value): ?string
    {
        $value = trim((string) $value);

        if ($value === '' || $value === '-') {
            return null;
        }

        $clean = str_replace([' ', '�'], '', $value);

        if (preg_match('/^\d{1}\.\d{3}\.\d{3}$/', $clean)) {
            $numeric = (float) str_replace('.', '', $clean);
            return number_format($numeric / 10000, 4, '.', '');
        }

        $clean = str_replace('.', '', $clean);
        $clean = str_replace(',', '.', $clean);

        if (is_numeric($clean)) {
            $number = (float) $clean;
            if ($number > 1000) {
                return number_format($number / 10000, 4, '.', '');
            }

            return number_format($number, 4, '.', '');
        }

        return $value;
    }

    protected function isHeaderRow(array $columns): bool
    {
        return isset($columns[0]) && str_contains($columns[0], 'DATA INFRASTRUKTUR');
    }

    protected function isRegionRow(array $columns): bool
    {
        return isset($columns[0], $columns[1]) && str_ends_with($columns[0], '.') && $columns[1] !== '';
    }

    protected function isSiteRow(array $columns): bool
    {
        return ($columns[0] ?? '') === '' && ($columns[1] ?? '') !== '' && ($columns[3] ?? '') !== '';
    }

    protected function isTowerRow(array $columns): bool
    {
        return ($columns[0] ?? '') === '' && ($columns[1] ?? '') === '' && ($columns[3] ?? '') !== '';
    }

    protected function isCoordinateSupplementRow(array $columns): bool
    {
        foreach ([0, 1, 2, 3] as $index) {
            if (! array_key_exists($index, $columns)) {
                continue;
            }

            if ($this->looksLikeCoordinate($columns[$index])) {
                return true;
            }
        }

        return false;
    }

    protected function looksLikeCoordinate(?string $value): bool
    {
        $value = trim((string) $value);
        if ($value === '' || $value === '-') {
            return false;
        }

        if (preg_match('/^[NSWE]/i', $value)) {
            return true;
        }

        if (str_contains($value, '°')) {
            return true;
        }

        $numeric = str_replace(',', '.', $value);
        $numeric = (float) preg_replace('/[^-\d\.]/', '', $numeric);

        return $numeric !== 0.0 && abs($numeric) <= 180;
    }

    protected function isLatitude(string $value): bool
    {
        return preg_match('/^[NS]/i', trim($value)) || abs((float) preg_replace('/[^-\d\.]/', '', str_replace(',', '.', $value))) <= 90;
    }

    protected function isLongitude(string $value): bool
    {
        return preg_match('/^[EW]/i', trim($value)) || abs((float) preg_replace('/[^-\d\.]/', '', str_replace(',', '.', $value))) <= 180;
    }

    protected function parseCoordinate(?string $value): ?float
    {
        $value = trim((string) $value);
        if ($value === '' || $value === '-') {
            return null;
        }

        $value = str_replace(',', '.', $value);

        if (preg_match('/^([NSWE])\s*(.*)$/i', $value, $matches)) {
            $direction = strtoupper($matches[1]);
            $value = trim($matches[2]);
        } else {
            $direction = null;
        }

        if (preg_match('/(-?\d+(?:\.\d+)?)/', $value, $matches) && ! str_contains($value, '°')) {
            $decimal = (float) $matches[1];
        } elseif (preg_match('/(\d+)\D+(\d+)\D+(\d+(?:\.\d+)?)/', $value, $matches)) {
            $decimal = (float) $matches[1] + ((float) $matches[2] / 60) + ((float) $matches[3] / 3600);
        } else {
            return null;
        }

        if (in_array($direction, ['S', 'W'], true) && $decimal > 0) {
            $decimal *= -1;
        }

        return round($decimal, 8);
    }

    protected function siteKey(?string $region, string $rawName): string
    {
        return Str::slug(($region ?? 'unknown') . '-' . $rawName);
    }

    protected function formatSiteName(string $rawName): string
    {
        $formatted = Str::title(Str::lower($rawName));
        return Str::startsWith($formatted, 'Site ') ? $formatted : 'Site ' . $formatted;
    }

    protected function formatRegion(?string $region): ?string
    {
        return $region ? Str::title(Str::lower($region)) : null;
    }

    protected function dataset(): string
    {
        return <<<'CSV'
DATA INFRASTRUKTUR JARKOM RADIO POLDA JAMBI DAN JAJARAN TAHUN 2024;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
NO;NA MA SITE;TITIK KOORDINAT / ALAMAT;TYPE REPEATER;SYSTEM (CONV/;FREK;;STATUS SITE;JENIS TOWER;TINGGI TOWER;KONDISI;;;DOKUMENTASI;PENGGUNA;KET
;;;;TRUNKING);RX;TX;;;;BB;RR;RB;;;
1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16
1.;POLDA JAMBI;;;;;;;;;;;;;;
;POLDA JAMBI;S 01° 36° 40.5°;MOTOROLA GTR8000;CONV;855,8125;810,8125;POLRI;SST;42M;1;-;-;Picture;POLDA JAMBI DAN;
;-1.61125°;E 103° 37° 25.6°;;;;;;;;;;;;POLRESTA JAMBI;
;103.62378°;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
2.;POLRESTA JAMBI;;;;;;;;;;;;;;
;POLSEKTA KOTABARU;S 01° 40° 11.9°;MOTOROLA TRUNKING 6 CH;TRUNKING;855,2375;810,2375;POLRI;SST;72 M;1;-;-;Picture;POLDA JAMBI DAN POLRESTA JAMBI;
;-1.66997°;E 103° 35° 46.2 °;;;855,4875;810,4875;;;;;;;;;
;103.59617°;;;;855,7375;810,7375;;;;;;;;;
;;;;;855,9875;810,9875;;;;;;;;;
;;;;;856,2375;811,2375;;;;;;;;;
;;;;;856,4875;811,4875;;;;;;;;;
;;;MOTOROLA GTR8000;CONV;856,7875;810,3625;;;;1;-;-;;DIT LANTAS;
;;;MOTOROLA GTR8000;CONV;855,0875;810,0875;;;;1;-;-;;SATBRIMOB;
;;;MOTOROLA MX800;CONV;855,8125;810,8125;;;;-;-;1;;POLDA JAMBI DAN POLRESTA JAMBI;
;;;MOTOROLA QUANTAR;CONV;856,9875;811,9875;;;;1;-;-;;DIT LANTAS;
;;;;;;;;;;;;;;;
3.;POLRES MUARO JAMBI;;;;;;;;;;;;;;
;POLRES MUARO JAMBI;S 01° 24° 42.8°;MOTOROLA GTR8000;CONV;856,0625;811,0625;POLRI;SST;72 M;1;-;-;Picture;POLRES MUARO JAMBI;
;-1.41189°;E 103° 29° 20.0°;;;;;;;;;;;;;
;103.48889°;;;;;;;;;;;;;;;
;;;MOTOROLA GTR8000;CONV;856,9625;811,9625;;;;-;1;-;;DITLANTAS;
;;;MOTOROLA QUANTAR;CONV;856,9625;811,9625;;;;-;-;1;;DITLANTAS;
;;;MOTOROLA MX800;CONV;856,0625;811,0625;;;;-;-;1;;POLRES MUARO JAMBI;
;;;;;;;;;;;;;;;
POLSEK .....;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
2;;;;;;;;;;;;;;;
1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16
;POLSEK MESTONG;S 01° 46° 05.6°;MOTOROLA GTR8000;CONV;855,9625;810,9625;POLRI;GWT;52 M;-;1;-;Picture;DITLANTAS;
;-1.76822°|;E 103° 33° 04.1°;;;;;;;;;;;;;
;103.55114°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;MOTOROLA QUANTAR;CONV;855,9625;810,9625;;;;-;-;1;;DITLANTAS;
;JALUKO;S 01° 35° 32.0°;MOTOROLA GTR8000;CONV;856,1125;811,1125;POLRI;SST;72 M;-;1;-;Picture;POLRES MUARO JAMBI;
;-1.59222°|;E 103° 28° 57.5°;;;;;;;;;;;;;
;103.48264°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;TELKOM MENDALO;-16.200.325.074.162.600,00;MOTOROLA GTR8000;CONV;8.551.125;8.101.125;TELKOM;SST;52 M;1;-;-;Picture;POLRES MUARO JAMBI;
;;1.035.315.037.081.650;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
4.;POLRES TANJAB TIMUR;;;;;;;;;;;;;;
;POLRES TANJAB TIMUR;S 01° 13° 00.0°;MOTOROLA GTR8000;CONV;855,6125;810,6125;POLRI;SST;72 M;1;-;-;Picture;POLRES TANJAB TIMUR;
;-1.21667°|;E 103 47° 25.8°;;;;;;;;;;;;;
;103.79050°|;;;;;;;;;;;;;;;
;TELKOM MUARA SABAK;S 01° 12° 27.7°;MOTOROLA MTR3000;CONV;856,3125;811,3125;TELKOM;SST;85 M;-;-;1;Picture;POLRES TANJAB TIMUR;
;-1.20769°|;E 103° 54° 12.1°;;;;;;;;;;;;;
;103.90336°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
5.;POLRES TANJAB BARAT;;;;;;;;;;;;;;
;POLRES TANJAB BARAT;S 00° 49° 09.5°;MOTOROLA TRUNKING 4 CH;TRUNKING;855,2375;810,2375;POLRI;SST;72 M;-;-;1;Picture;POLRES TANJAB BARAT;
;-0.81931°|;E 103° 27° 56.8°;;;855,4875;810,4875;;;;;;;;;
;103.46578°|;;;;855,7375;810,7375;;;;;;;;;
;;;;;855,9875;810,9875;;;;;;;;;
;TELKOM KUALA TUNGKAL;S 01° 32° 15.2°;MOTOROLA GTR8000;CONV;856,5875;811,5875;TELKOM;SST;72 M;1;-;-;Picture;POLRES TANJAB BARAT;
;-1.53756°|;E 103 39° 44.2°;;;;;;;;;;;;;
;103.66228°|;;;;;;;;;;;;;;;
;TELKOM BUKIT TAMBI;S 01° 17° 52.3°;MOTOROLA MTR3000;CONV;855,7625;810,7625;TELKOM;SST;105 M;1;-;-;Picture;POLRES TANJAB BARAT;
;-1.29786°|;E 103° 13° 05.6°;;;;;;;;;;;;;
;103.21822°|;;;;;;;;;;;;;;;
;YON A  KOMPI BRIMOB BETARA;S 01° 08° 06.3°;MOTOROLA GTR8000;CONV;855,3375;810,3375;POLRI;SST;72 M;1;-;-;Picture;SAT BRIMOB;
;-1.13508°|;E 103° 23° 32.8°;;;;;;;;;;;;;
;103.39244°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
6.;POLRES BATANGHARI;;;;;;;;;;;;;;
;POLRES BATANGHARI;S 01° 45° 23.1°;MOTOROLA GTR8000;CONV;856,7625;811,7625;POLRI;SST;92 M;1;-;-;Picture;POLRES BATANGHARI;
;-1.75642°|;E 103° 16° 28.1°;;;;;;;;;;;;;
;103.27447°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
MOTOROLA .....;;;;;;;;;;;;;;;
3;;;;;;;;;;;;;;;
1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16
;;;MOTOROLA GTR8000;CONV;855,587;810,5875;;;;1;-;-;;SAT BRIMOB;
;;;MOTOROLA GTR8000;CONV;856,4625;811,4625;;;;-;1;-;;DITLANTAS;
;;;MOTOROLA QUANTAR;CONV;856,4625;811,4625;;;;-;-;1;;DIT LANTAS;
;PEMAYUNG;S 01° 36° 54.8°;MOTOROLA GTR8000;CONV;856,6125;811,6125;POLRI;SST;72 M;-;1;-;Picture;POLRES BATANGHARI;
;-1.61522°|;E 103° 20° 59.5°;;;;;;;;;;;;;
;103.34986°|;;;;;;;;;;;;;;;
;TELKOM BUKIT PAKU;S 01° 40° 21.1°;MOTOROLA GTR8000;CONV;8.565.875;811,5875;TELKOM;SST;85 M;1;-;-;Picture;POLRES BATANGAHRI;
;-1.67253°|;E 103° 05° 24.8°;;;;;;;;;;;;;
;103.09022°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;MUARA TEMBESI;S 01° 47° 19.1°;MOTOROLA GTR8000;CONV;856,8125;811,8125;POLRI;SST;92 M;-;1;-;Picture;POLRES BATANGHARI;
;-1.78864°|;E 103° 05° 29.3°;;;;;;;;;;;;;
;103.09147°|;;;;;;;;;;;;;;;
;;;MOTOROLA GTR8000;CONV;855,1125;810,1125;;;;-;1;-;;DIT LANTAS;
;;;MOTOROLA QUANTAR;CONV;855,1125;810,1125;;;;-;-;1;;DIT LANTAS;
;;;;;;;;;;;;;;;
7.;POLRES SAROLANGUN;;;;;;;;;;;;;;
;POLRES SAROLANGUN;S 02° 22° 25.4°;MOTOROLA GTR8000;CONV;856,1125;811,1125;POLRI;SST;72 M;1;-;-;Picture;POLRES SAROLANGUN;
;-2.37372°|;E 102 42° 56.7°;;;;;;;;;;;;;
;102.70850°|;;;;;;;;;;;;;;;
;POLSEKTA SAROLANGUN;S 02° 18° 16.4°;MOTOROLA TRUNKIN 4 CH;TRUNKING;855,2375;810,2375;POLRI;SST;72 M;-;-;1;Picture;POLRES SAROLANGUN;
;-2.30456°|;E 102° 42° 30.6°;;;855,4875;810,4875;;;;;;;;;
;102.70850°|;;;;855,7375;810,7375;;;;;;;;;
;;;;;855,9875;810,9875;;;;;;;;;
;TELKOM PAUH;S 02° 08° 36.6°;MOTOROLA GTR8000;CONV;856,0625;811,0625;TELKOM;SST;85 M;-;1;-;Picture;POLRES SAROLANGUN;
;-2.14350°|;E 102° 48° 54.3°;;;;;;;;;;;;;
;102.81508°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;POLSEK MANDIANGIN;S 02° 01° 13.9°;MOTOROLA GT8000;CONV;855,8125;810,8125;POLRI;SST;92 M;-;1;-;Picture;DIT LANTAS;
;-2.02053°|;E 102° 59° 11.6°;;;;;;;;;;;;;
;102.98656°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;RADIO BRIDGE BACK TO BACK APX2500;CONV;TX : 855,5870;TX :  855,8375;;;;1;-;-;;SAT BRIMOB;
;;;;;RX : 810,5875;RX : 810,8375;;;;;;;;;
;BUKIT PEDUKUH;S 02° 16° 11.7°;MOTOROLA GTR8000;CONV;855,1125;810,1125;TELKOM;SST;85 M;-;-;1;Picture;POLRES SAROLANGUN;
;-2.26992°|;E 102° 35° 19.0°;;;;;;;;;;;;;
;102.58861°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;TVRI SAROLANGUN;S 02° 18° 16.4°;MOTOROLA GTR8000;CONV;855,3125;810,3125;TVRI;SST;52 M;-;1;-;Picture;DIT LANTAS;
;-2.30456°|;E 102° 42° 30.6°;;;;;;;;;;;;;
;102.70850°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;MOTOROLA QUANTAR;CONV;855,3125;810,3125;;;;-;-;1;;DIT LANTAS;
;;;;;;;;;;;;;;;
INDOSAT .....;;;;;;;;;;;;;;;
4;;;;;;;;;;;;;;;
1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16
;INDOSAT PAUH;S 02° 08° 18.3°;MICROWAVE LINK;DATA;-;-;INDOSAT;SST;72 M;-;-;1;Picture;DIT LANTAS;
;-2.13842°|;E 102° 48° 55.5°;;;;;;;;;;;;;
;102.81542°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
8.;POLRES MERANGIN;;;;;;;;;;;;;;
;TELKOM BANGKO;S 02° 03° 51.6°;MOTOROLA GTR8000;CONV;856,8375;810,3625;TELKOM;SST;85 M;1;-;-;Picture;POLRES MERANGIN;
;-2.06433°|;E 102° 16° 32.0°;;;;;;;;;;;;;
;102.27556°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;SUNGAI ULAK;S 02° 00° 39.5°;MOTOROLA GTR8000;CONV;855,8125;810,8125;POLRI;SST;72 M;-;-;1;Picture;POLRES MERANGIN;
;-2.01097°|;E 102° 16° 50.1°;;;;;;;;;;;;;
;102.28058°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;MOTOROLA QUANTAR;CONV;856,8375;810,3625;;;;-;-;1;;DIT LANTAS;
;POLSEK TABIR;S 01° 50° 04.4°;MOTOROLA GTR8000;CONV;856,8875;811,8875;POLRI;SST;72 M;-;1;-;Picture;POLRES MERANGIN;
;-1.08456°|;E 102° 17° 32.2°;;;;;;;;;;;;;
;102.29228°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;MOTOROLA QUANTAR;CONV;856,8875;811,8875;;;;-;-;1;;DIT LANTAS;
;;;;;;;;;;;;;;;
;POLSEK PAMENANG;S 02° 08° 32.2°;MOTOROLA QUANTAR;CONV;856,9125;811,9125;POLRI;SST;72 M;-;-;1;Picture;DIT LANTAS;
;-2.14228°|;E 102° 30° 32.7°;;;;;;;;;;;;;
;102.50908|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;YON B BRIMOB PAMENANG;S 02° 04° 33.5°;MOTOROLA GTR8000;CONV;855,8375;810,8375;POLRI;SST;72 M;1;-;-;Picture;SAT BRIMOB;
;-2.07597°|;E 102° 26° 03.2°;;;;;;;;;;;;;
;102.43422°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
9.;POLRES KERINCI;;;;;;;;;;;;;;
;POLRES KERINCI;S 02° 04° 17.6 °;MOTOROLA GTR8000;CONV;856,3125;811,3125;POLRI;SST;72 M;1;-;-;Picture;POLRES KERINCI;
;-2.07156°|;E 101° 23° 47.6 °;;;;;;;;;;;;;
;101.39656°|;;;;;;;;;;;;;;;
;;;MOTOROLA MX800;CONV;856,3125;811,3125;POLRI;;;-;-;1;;POLRES KERINCI;
;;;;;;;;;;;;;;;
10.;POLRES BUNGO;;;;;;;;;;;;;;
;TELKOM MUARA BUNGO;S 01° 29° 51.9°;MOTOROLA GTR8000;CONV;855,5625;810,5625;TELKOM;SST;95 M;1;-;-;Picture;POLRES BUNGO;
;-1.49775°|;E 102 07° 01.1°;;;;;;;;;;;;;
;102.11697°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;MOTOROLA MX800;CONV;855,5625;810,5625;;;;1;-;-;;POLRES BUNGO;
;;;;;;;;;;;;;;;
POLSEK .....;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
5;;;;;;;;;;;;;;;
1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16
;POLSEK PELEPAT;S 01° 42° 38.8°;MOTOROLA GTR8000;CONV;856,3375;811,3375;POLRI;SST;42 M;1;-;-;Picture;POLRES BUNGO;
;-1.71078°|;E 102° 10° 51.8°;;;;;;;;;;;;;
;102.18106°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;SAT LANTAS POLRES BUNGO;S 01° 24° 47.1°;MOTOROLA GTR8000;CONV;856,5875;811,5875;POLRI;SST;42 M;1;-;-;Picture;POLRES BUNGO;
;-1.41308°|;E 102° 05° 11.1°;;;;;;;;;;;;;
;102.08642°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;POLSEK PELAYANG;S 01° 22° 32.4°;MOTOROLA GT8000;CONV;856,0875;811,0875;POLRI;SST;42 M;1;-;-;Picture;POLRES BUNGO;
;-1.37567°|;E 101° 49° 47.2°;;;;;;;;;;;;;
;101.82978°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;TELKOM KUAMANG KUNING;S 01° 37° 00.0°;MOTOROLA GTR8000;CONV;856,3625;811,3625;TELKOM;SST;72 M;1;-;-;Picture;POLRES BUNGO;
;-1.61667°|;E 102° 21° 06.6°;;;;;;;;;;;;;
;102.35183°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;TANAH SEPENGGAL LINTAS;S 01° 23° 57.1°;MOTOROLA QUANTAR;CONV;8.569.125;811,9125;POLRI;GWT;52 M;-;-;1;Picture;DIT LANTAS;
;-1.39919°|;E 102 02° 23.2°;;;;;;;;;;;;;
;102.03978°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;DIT LANTAS;
11.;POLRES TEBO;;;;;;;;;;;;;;
;TELKOM MUARA TEBO;S 01° 26° 46.2°;MOTOROLA GTR8000;CONV;855,3125;810,3125;TELKOM;SST;55 M;1;-;-;Picture;POLRES TEBO;
;-1.44617°|;E 102° 26° 30.1°;;;;;;;;;;;;;
;102.44169°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;MOTOROLA MX800;CONV;855,3125;810,3125;;;;-;-;1;;POLRES TEBO;
;POLRES TEBO;S 01° 28° 29.4°;MOTOROLA MTR3000;CONV;856,9875;811,9875;POLRI;SST;72 M;-;-;1;Picture;POLRES TEBO;
;-1.47483°|;E 102° 27° 37.5°;;;;;;;;;;;;;
;102.46042°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;POLSEK TEBO ILIR;S 01° 32° 58.8°;MOTOROLA GTR8000;CONV;855,7625;810,7625;POLRI;SST;72 M;-;1;-;Picture;POLRES TEBO;
;-1.54967°|;E 102° 43° 30.3°;;;;;;;;;;;;;
;102.72508°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;TELKOM RIMBO BUJANG;S 01° 18° 42.2°;MOTOROLA GTR8000;CONV;855,9625;810,9625;TELKOM;SST;42 M;1;-;-;Picture;POLRES TEBO;
;-1.31172°|;E 102° 06° 23.3°;;;;;;;;;;;;;
;102.10647°|;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
;;;;;;;;;;;;;;;
CSV;
    }
}
