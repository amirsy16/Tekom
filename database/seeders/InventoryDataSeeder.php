<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventory;
use App\Models\EquipmentType;
use App\Models\Organization;
use App\Models\Site;

class InventoryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mapping satwil to organization name
        $organizationMapping = [
            'POLDA JAMBI' => 'Polda Jambi',
            'POLRE STA JAMBI' => 'Polresta Jambi',
            'POLRES MUARO JAMBI' => 'Polres Muaro Jambi',
            'POLRES TANJAB BARAT' => 'Polres Tanjung Jabung Barat',
            'POLRES TANJAB TIMUR' => 'Polres Tanjung Jabung Timur',
            'POLRES BATANGHARI' => 'Polres Batanghari',
            'POLRES SAROLANGUN' => 'Polres Sarolangun',
            'POLRES MERANGIN' => 'Polres Merangin',
            'POLRES BUNGO' => 'Polres Bungo',
            'POLRES TEBO' => 'Polres Tebo',
            'POLRES KERINCI' => 'Polres Kerinci',
            'KAPOLDA' => 'Polda Jambi',
            'WAKAPOLDA' => 'Polda Jambi',
            'ITWASDA' => 'Polda Jambi',
            'BIROOPS' => 'Polda Jambi',
            'BIRORENA' => 'Polda Jambi',
            'BIRO SDM' => 'Polda Jambi',
            'BIROLOG' => 'Polda Jambi',
            'DITINTELKAM' => 'Polda Jambi',
            'DITRESKRIMUM' => 'Polda Jambi',
            'DITRESKRIMSUS' => 'Polda Jambi',
            'DITRESNARKOBA' => 'Polda Jambi',
            'DITBINMAS' => 'Polda Jambi',
            'DITSABHARA' => 'Polda Jambi',
            'DITLANTAS' => 'Polda Jambi',
            'DITPAMOBVIT' => 'Polda Jambi',
            'DITPOLAIR' => 'Polda Jambi',
            'DITTAHTI' => 'Polda Jambi',
            'SAT BRIMOB' => 'Polda Jambi',
            'SPN JAMBI' => 'Polda Jambi',
            'SPKT' => 'Polda Jambi',
            'BIDKEU' => 'Polda Jambi',
            'BIDDOKKES' => 'Polda Jambi',
            'BIDPROPAM' => 'Polda Jambi',
            'BID TIK' => 'Polda Jambi',
            'BIDHUMAS' => 'Polda Jambi',
            'BIDKUM' => 'Polda Jambi',
            'KORSPRI' => 'Polda Jambi',
            'YANMA' => 'Polda Jambi',
            'SETUM' => 'Polda Jambi',
            'POLRESTA JAMBI' => 'Polresta Jambi',
        ];
        
        // Data dari Slide 1-10
        $data = [
            // POLDA JAMBI
            ['org' => 'POLDA JAMBI', 'unit' => 'Site Polda Jambi', 'site' => 'Site Polda Jambi SST 42 M', 'equipment' => 'GTR800 + MSO TRUNKING', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Polda Jambi SST 42 M', 'equipment' => 'KOMOB RPT GTR8000', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Sat Brimob Polda Jambi', 'site' => 'Site Polda Jambi SST 42 M', 'equipment' => 'KOMOB RPT 8X800', 'year' => 2024, 'condition' => 'BB', 'qty' => 1],
            
            // POLRE STA JAMBI
            ['org' => 'POLRE STA JAMBI', 'unit' => 'Site Polsekta Kotabaru', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'MX800', 'year' => 2004, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRE STA JAMBI', 'unit' => 'Polresta Jambi', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRE STA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'GTR8000', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRE STA JAMBI', 'unit' => 'Sat Brimob', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'GTR8000', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRE STA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'GTR 8000 6 CHANEL (TRUNKING)', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRE STA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'KENWOOD', 'year' => 2016, 'condition' => 'RB', 'qty' => 1],
            
            // POLRES MUARO JAMBI
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Site Polres Muaro Jambi', 'site' => 'Site Polres Muaro Jambi SST 72 M', 'equipment' => 'MX800', 'year' => 2004, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => 'Site Polres Muaro Jambi SST 72 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Polres Muaro Jambi SST 72 M', 'equipment' => 'QUANTAR', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Polres Muaro Jambi SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Site Jaluko', 'site' => 'Site Jaluko SST 72 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Site Telkom Mendalo', 'site' => 'Site Telkom Mendalo SST 52 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Site Polsek Mestong', 'site' => 'Site Polsek Mestong GWT 52 M', 'equipment' => 'QUANTAR', 'year' => 2007, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Polsek Mestong GWT 52 M', 'equipment' => 'GTR8000', 'year' => 2015, 'condition' => 'RR', 'qty' => 1],
            
            // POLRES TANJAB BARAT
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Site Polres Tanjab Barat', 'site' => 'Site Polres Tanjab Barat SST 72 M', 'equipment' => 'GTR8000 Trunking 4 Chanel', 'year' => 2017, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Site Telkom Kuala Tungkal', 'site' => 'Site Telkom Kuala Tungkal SST 72 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Site Telkom Bukit Tambi', 'site' => 'Site Telkom Bukit Tambi SST 105 M', 'equipment' => 'MTR3000', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Site Kompi Brimob Betara', 'site' => 'Site Kompi Brimob Betara SST 72 M', 'equipment' => 'GTR8000', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES TANJAB TIMUR
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Site Muara Sabak', 'site' => 'Site Muara Sabak SST 72 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Site Telkom Muara Sabak', 'site' => 'Site Telkom Muara Sabak SST 85 M', 'equipment' => 'MTR3000', 'year' => 2015, 'condition' => 'RB', 'qty' => 1],
            
            // POLRES BATANGHARI
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Site Polres Batanghari', 'site' => 'Site Polres Batanghari SST 92 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => 'Site Polres Batanghari SST 92 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Bid TIK', 'site' => 'Site Polres Batanghari SST 92 M', 'equipment' => 'GTR8000', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Sat Brimob Polda Jambi', 'site' => 'Site Polres Batanghari SST 92 M', 'equipment' => 'GTR8000', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Site Pemayung', 'site' => 'Site Pemayung SST 72 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Site Muara Tembesi', 'site' => 'Site Muara Tembesi SST 92 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => 'Site Muara Tembesi SST 92 M', 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Bid TIK', 'site' => 'Site Muara Tembesi SST 92 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Site Telkom Bukit Paku', 'site' => 'Site Telkom Bukit Paku SST 85 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'RR', 'qty' => 1],
            
            // POLRES SAROLANGUN
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Site Polsek Mandiangin', 'site' => 'Site Polsek Mandiangin SST 92 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Sat Brimob Polda Jambi', 'site' => 'Site Polsek Mandiangin SST 92 M', 'equipment' => 'RADIO LINK APX2500', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Site Polres Sarolangun', 'site' => 'Site Polres Sarolangun SST 42 M', 'equipment' => 'GTR8000', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Site Polsekta Sarolangun', 'site' => 'Site Polsekta Sarolangun SST 72 M', 'equipment' => 'GTR8000 Trunking 4 Chanel', 'year' => 2017, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Pauh SST 85 M', 'equipment' => 'GTR8000', 'year' => 2017, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => 'Site Telkom Bukit Pedukuh SST 85 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Site TVRI Sarolangun', 'site' => 'Site TVRI Sarolangun SST 52 M', 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Bid TIK', 'site' => 'Site TVRI Sarolangun SST 52 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Site Indosat Pauh', 'site' => 'Site Indosat Pauh SST 72 M', 'equipment' => 'Microwave Link', 'year' => 2006, 'condition' => 'RB', 'qty' => 1],
            
            // POLRES MERANGIN
            ['org' => 'POLRES MERANGIN', 'unit' => 'Bid TIK', 'site' => 'Site Polsek Pamenang SST 72 M', 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Site Sungai Ulak Bangko', 'site' => 'Site Sungai Ulak Bangko SST 72 M', 'equipment' => 'GTR9000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => 'Site Sungai Ulak Bangko SST 72 M', 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Site Polsek Tabir', 'site' => 'Site Polsek Tabir SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Bid TIK', 'site' => 'Site Polsek Tabir SST 72 M', 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Site Yon B Brimob Pamenang', 'site' => 'Site Yon B Brimob Pamenang SST 72 M', 'equipment' => 'GTR8000', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Sat brimob Polda Jambi', 'site' => 'Site Yon B Brimob Pamenang SST 72 M', 'equipment' => 'GTR8000', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Site Telkom Bangko', 'site' => 'Site Telkom Bangko SST 85 M', 'equipment' => 'GTR8000', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES BUNGO
            ['org' => 'POLRES BUNGO', 'unit' => 'Bid TIK', 'site' => 'Site Tanah Sepenggal Lintas GWT 52 M', 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Site Polsek Pelepat', 'site' => 'Site Polsek Pelepat 42 M', 'equipment' => 'GTR8000', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Site Sat Lantas Polres Bungo', 'site' => 'Site Sat Lantas Polres Bungo SST 42 M', 'equipment' => 'GTR8000', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Sat Lantas Polres Bungo SST 42 M', 'equipment' => 'GTR8000', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Site Polsek Pelayang', 'site' => 'Site Polsek Pelayang SST 42 M', 'equipment' => 'GTR8000', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Polsek Pelayang SST 42 M', 'equipment' => 'GTR8000', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Site Telkom Muara Bungo', 'site' => 'Site Telkom Muara Bungo SST 95 M', 'equipment' => 'MX800', 'year' => 2004, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Telkom Muara Bungo SST 95 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Site Telkom Kuamang Kuning', 'site' => 'Site Telkom Kuamang Kuning SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Telkom Kuamang Kuning SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES TEBO
            ['org' => 'POLRES TEBO', 'unit' => 'Site Polres Tebo', 'site' => 'Site Polres Tebo SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => 'Site Polres Tebo SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Site Polsek Tebo Ilir', 'site' => 'Site Polsek Tebo Ilir SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => 'Site Polsek Tebo Ilir SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Site TelKom Muara Tebo', 'site' => 'Site TelKom Muara Tebo SST 52 M', 'equipment' => 'MX800', 'year' => 2004, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => 'Site TelKom Muara Tebo SST 52 M', 'equipment' => 'MTR3000', 'year' => 2015, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Site Telkom Rimbo Bujang', 'site' => 'Site Telkom Rimbo Bujang SST 42 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => 'Site Telkom Rimbo Bujang SST 42 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES KERINCI
            ['org' => 'POLRES KERINCI', 'unit' => 'Site POLRES KERINCI', 'site' => 'Site POLRES KERINCI SST 72 M', 'equipment' => 'MX800', 'year' => 2004, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => 'Site POLRES KERINCI SST 72 M', 'equipment' => 'MX800', 'year' => 2004, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres kerinci', 'site' => 'Site POLRES KERINCI SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            
            // KAPOLDA - ALKOM (Radio Fixed, Radio Mobile, HT)
            ['org' => 'KAPOLDA', 'unit' => 'KAPOLDA', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'KAPOLDA', 'unit' => 'KAPOLDA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'KAPOLDA', 'unit' => 'KAPOLDA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'KAPOLDA', 'unit' => 'KAPOLDA', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'KAPOLDA', 'unit' => 'KAPOLDA', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // WAKAPOLDA - ALKOM
            ['org' => 'WAKAPOLDA', 'unit' => 'WAKAPOLDA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'WAKAPOLDA', 'unit' => 'WAKAPOLDA', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'WAKAPOLDA', 'unit' => 'WAKAPOLDA', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // ITWASDA - ALKOM
            ['org' => 'ITWASDA', 'unit' => 'ITWASDA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'ITWASDA', 'unit' => 'ITWASDA', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'ITWASDA', 'unit' => 'ITWASDA', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // BIROOPS - ALKOM
            ['org' => 'BIROOPS', 'unit' => 'BIROOPS', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIROOPS', 'unit' => 'BIROOPS', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 5],
            ['org' => 'BIROOPS', 'unit' => 'BIROOPS', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'BIROOPS', 'unit' => 'BIROOPS', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 3],
            
            // BIRORENA - ALKOM
            ['org' => 'BIRORENA', 'unit' => 'BIRORENA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIRORENA', 'unit' => 'BIRORENA', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIRORENA', 'unit' => 'BIRORENA', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIRORENA', 'unit' => 'BIRORENA', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // BIRO SDM - ALKOM
            ['org' => 'BIRO SDM', 'unit' => 'BIRO SDM', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIRO SDM', 'unit' => 'BIRO SDM', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIRO SDM', 'unit' => 'BIRO SDM', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // BIROLOG - ALKOM
            ['org' => 'BIROLOG', 'unit' => 'BIROLOG', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIROLOG', 'unit' => 'BIROLOG', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIROLOG', 'unit' => 'BIROLOG', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // DITINTELKAM - ALKOM
            ['org' => 'DITINTELKAM', 'unit' => 'DITINTELKAM', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITINTELKAM', 'unit' => 'DITINTELKAM', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITINTELKAM', 'unit' => 'DITINTELKAM', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'DITINTELKAM', 'unit' => 'DITINTELKAM', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 15],
            ['org' => 'DITINTELKAM', 'unit' => 'DITINTELKAM', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITRESKRIMUM - ALKOM
            ['org' => 'DITRESKRIMUM', 'unit' => 'DITRESKRIMUM', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITRESKRIMUM', 'unit' => 'DITRESKRIMUM', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITRESKRIMUM', 'unit' => 'DITRESKRIMUM', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'DITRESKRIMUM', 'unit' => 'DITRESKRIMUM', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 40],
            ['org' => 'DITRESKRIMUM', 'unit' => 'DITRESKRIMUM', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITRESKRIMSUS - ALKOM
            ['org' => 'DITRESKRIMSUS', 'unit' => 'DITRESKRIMSUS', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITRESKRIMSUS', 'unit' => 'DITRESKRIMSUS', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 6],
            ['org' => 'DITRESKRIMSUS', 'unit' => 'DITRESKRIMSUS', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 30],
            ['org' => 'DITRESKRIMSUS', 'unit' => 'DITRESKRIMSUS', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITRESNARKOBA - ALKOM (Slide 21)
            ['org' => 'DITRESNARKOBA', 'unit' => 'DITRESNARKOBA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITRESNARKOBA', 'unit' => 'DITRESNARKOBA', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 5],
            ['org' => 'DITRESNARKOBA', 'unit' => 'DITRESNARKOBA', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 30],
            ['org' => 'DITRESNARKOBA', 'unit' => 'DITRESNARKOBA', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITBINMAS - ALKOM (Slide 22)
            ['org' => 'DITBINMAS', 'unit' => 'DITBINMAS', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITBINMAS', 'unit' => 'DITBINMAS', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 6],
            ['org' => 'DITBINMAS', 'unit' => 'DITBINMAS', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITSABHARA - ALKOM (Slide 23)
            ['org' => 'DITSABHARA', 'unit' => 'DITSABHARA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITSABHARA', 'unit' => 'DITSABHARA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITSABHARA', 'unit' => 'DITSABHARA', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITSABHARA', 'unit' => 'DITSABHARA', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 4],
            ['org' => 'DITSABHARA', 'unit' => 'DITSABHARA', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 22],
            ['org' => 'DITSABHARA', 'unit' => 'DITSABHARA', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 60],
            ['org' => 'DITSABHARA', 'unit' => 'DITSABHARA', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'DITSABHARA', 'unit' => 'DITSABHARA', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITLANTAS - ALKOM (Slide 24)
            ['org' => 'DITLANTAS', 'unit' => 'DITLANTAS', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 6],
            ['org' => 'DITLANTAS', 'unit' => 'DITLANTAS', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITLANTAS', 'unit' => 'DITLANTAS', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 15],
            ['org' => 'DITLANTAS', 'unit' => 'DITLANTAS', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 40],
            ['org' => 'DITLANTAS', 'unit' => 'DITLANTAS', 'site' => null, 'equipment' => 'HT', 'year' => 2014, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'DITLANTAS', 'unit' => 'DITLANTAS', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 150],
            ['org' => 'DITLANTAS', 'unit' => 'DITLANTAS', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'DITLANTAS', 'unit' => 'DITLANTAS', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITPAMOBVIT - ALKOM (Slide 25)
            ['org' => 'DITPAMOBVIT', 'unit' => 'DITPAMOBVIT', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITPAMOBVIT', 'unit' => 'DITPAMOBVIT', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITPAMOBVIT', 'unit' => 'DITPAMOBVIT', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITPAMOBVIT', 'unit' => 'DITPAMOBVIT', 'site' => null, 'equipment' => 'HT', 'year' => 2014, 'condition' => 'BB', 'qty' => 15],
            ['org' => 'DITPAMOBVIT', 'unit' => 'DITPAMOBVIT', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'DITPAMOBVIT', 'unit' => 'DITPAMOBVIT', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITPOLAIR - ALKOM (Slide 26)
            ['org' => 'DITPOLAIR', 'unit' => 'DITPOLAIR', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITPOLAIR', 'unit' => 'DITPOLAIR', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITPOLAIR', 'unit' => 'DITPOLAIR', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITPOLAIR', 'unit' => 'DITPOLAIR', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 15],
            ['org' => 'DITPOLAIR', 'unit' => 'DITPOLAIR', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 22],
            ['org' => 'DITPOLAIR', 'unit' => 'DITPOLAIR', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 30],
            ['org' => 'DITPOLAIR', 'unit' => 'DITPOLAIR', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // DITTAHTI - ALKOM (Slide 27)
            ['org' => 'DITTAHTI', 'unit' => 'DITTAHTI', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'DITTAHTI', 'unit' => 'DITTAHTI', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'DITTAHTI', 'unit' => 'DITTAHTI', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // SAT BRIMOB - ALKOM (Slide 28) - Tower, Repeater, Radio Fixed, Radio Mobile, HT
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'TOWER', 'year' => 2019, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2019, 'condition' => 'BB', 'qty' => 4],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'KOMOB RPT', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'KOMOB RPT', 'year' => 2024, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2019, 'condition' => 'BB', 'qty' => 10],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2019, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'HT', 'year' => 2012, 'condition' => 'BB', 'qty' => 56],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 35],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 30],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 100],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'HT', 'year' => 2019, 'condition' => 'BB', 'qty' => 86],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'HT', 'year' => 2021, 'condition' => 'BB', 'qty' => 9],
            ['org' => 'SAT BRIMOB', 'unit' => 'SAT BRIMOB', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            
            // SPN JAMBI - ALKOM (Slide 29)
            ['org' => 'SPN JAMBI', 'unit' => 'SPN JAMBI', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SPN JAMBI', 'unit' => 'SPN JAMBI', 'site' => null, 'equipment' => 'HT', 'year' => 2012, 'condition' => 'BB', 'qty' => 25],
            ['org' => 'SPN JAMBI', 'unit' => 'SPN JAMBI', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SPN JAMBI', 'unit' => 'SPN JAMBI', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'SPN JAMBI', 'unit' => 'SPN JAMBI', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // SPKT - ALKOM (Slide 30)
            ['org' => 'SPKT', 'unit' => 'SPKT', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SPKT', 'unit' => 'SPKT', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SPKT', 'unit' => 'SPKT', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SPKT', 'unit' => 'SPKT', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'SPKT', 'unit' => 'SPKT', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // BIDKEU - ALKOM (Slide 31)
            ['org' => 'BIDKEU', 'unit' => 'BIDKEU', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIDKEU', 'unit' => 'BIDKEU', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // BIDDOKKES - ALKOM (Slide 32)
            ['org' => 'BIDDOKKES', 'unit' => 'BIDDOKKES', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIDDOKKES', 'unit' => 'BIDDOKKES', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // BIDPROPAM - ALKOM (Slide 33)
            ['org' => 'BIDPROPAM', 'unit' => 'BIDPROPAM', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIDPROPAM', 'unit' => 'BIDPROPAM', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'BIDPROPAM', 'unit' => 'BIDPROPAM', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'BIDPROPAM', 'unit' => 'BIDPROPAM', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // BID TIK - REPEATER (Slide 34)
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'TRUNKING 800 MHZ', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'RB', 'qty' => 2],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'QUANTAR', 'year' => 2006, 'condition' => 'RB', 'qty' => 4],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'QUANTAR', 'year' => 2007, 'condition' => 'RB', 'qty' => 3],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'KENWOOD TKR900', 'year' => 2008, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'GTR8000', 'year' => 2016, 'condition' => 'RR', 'qty' => 5],
            
            // BID TIK - RADIO FIXED (Slide 34)
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2015, 'condition' => 'BB', 'qty' => 4],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2015, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 4],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'RB', 'qty' => 2],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2023, 'condition' => 'BB', 'qty' => 3],
            
            // BID TIK - RADIO MOBILE (Slide 35)
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2009, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 15],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'RB', 'qty' => 7],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'RR', 'qty' => 9],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'RB', 'qty' => 10],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2023, 'condition' => 'BB', 'qty' => 10],
            
            // BID TIK - HT (Slide 35)
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'RR', 'qty' => 3],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 24],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 4],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 100],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'HT', 'year' => 2023, 'condition' => 'BB', 'qty' => 100],
            
            // BID TIK - ANDROID (Slide 35)
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 4],
            
            // BID TIK - REPAIR VAN (Slide 36)
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'REPAIR VAN', 'year' => 2009, 'condition' => 'BB', 'qty' => 2],
            
            // BID TIK - ROUTER (Slide 36)
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BID TIK', 'unit' => 'BID TIK', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // TOWER POLRI (Slide 37-38)
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Batanghari', 'equipment' => 'TOWER POLRI SST 92M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polsek Mandiangin', 'equipment' => 'TOWER POLRI SST 92M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Ma. Tembesi', 'equipment' => 'TOWER POLRI SST 92M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polsek Pamenang', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polsek Tabir', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Sungai Ulak/Bangko', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polres Ma. Jambi', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polsek Kotabaru', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polres Tebo', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polsek Tebo Ilir', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polres Kerinci', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Ma. Sabak', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Jaluko', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Pemayung', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polres Tanjab Barat', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polsekta Sarolangun', 'equipment' => 'TOWER POLRI SST 72M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polda Jambi', 'equipment' => 'TOWER POLRI SST 42M', 'year' => 1998, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polres Sarolangun', 'equipment' => 'TOWER POLRI SST 42M', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polsek Pelepat', 'equipment' => 'TOWER POLRI SST 42M', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Sat Lantas Polres Bungo', 'equipment' => 'TOWER POLRI SST 42M', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Polsek Pelayang', 'equipment' => 'TOWER POLRI SST 42M', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Mestong', 'equipment' => 'TOWER POLRI GWT 52M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Tower Polri', 'site' => 'Site Tnh Sepenggal Lintas', 'equipment' => 'TOWER POLRI GWT 52M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            
            // SHELTER POLRI (Slide 39-40)
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polda Jambi', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 1998, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Batanghari', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsek Mandiangin', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site TVRI Sarolangun', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsek Pamenang', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Sungai Ulak/Bangko', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsek Tabir', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Tanah Sepenggal Lintas', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polres Muaro Jambi', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsek Mestong', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Ma. Tembesi', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polres Sarolangun', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polres Tebo', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsek Tebo Ilir', 'equipment' => 'SHELTER POLRI 3MX3M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polres Kerinci', 'equipment' => 'SHELTER POLRI 3MX4M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Jaluko', 'equipment' => 'SHELTER POLRI 3MX4M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Pemayung', 'equipment' => 'SHELTER POLRI 3MX4M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polres Tanjab Barat', 'equipment' => 'SHELTER POLRI 3MX4M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polres Tanjab Timur', 'equipment' => 'SHELTER POLRI 3MX4M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsekta Sarolangun', 'equipment' => 'SHELTER POLRI 4MX6M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsek Pelepat', 'equipment' => 'SHELTER POLRI 4MX6M', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Satlantas Bungo', 'equipment' => 'SHELTER POLRI 4MX6M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsek Pelayang', 'equipment' => 'SHELTER POLRI 4MX6M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polda Jambi (MSO)', 'equipment' => 'SHELTER POLRI 4MX8M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Shelter Polri', 'site' => 'Site Polsekta Kotabaru', 'equipment' => 'SHELTER POLRI 4MX8M', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            
            // BIDHUMAS - ALKOM (Slide 41)
            ['org' => 'BIDHUMAS', 'unit' => 'BIDHUMAS', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'BIDHUMAS', 'unit' => 'BIDHUMAS', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'BIDHUMAS', 'unit' => 'BIDHUMAS', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // BIDKUM - ALKOM (Slide 42)
            ['org' => 'BIDKUM', 'unit' => 'BIDKUM', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'BIDKUM', 'unit' => 'BIDKUM', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // KORSPRI - ALKOM (Slide 43)
            ['org' => 'KORSPRI', 'unit' => 'KORSPRI', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'KORSPRI', 'unit' => 'KORSPRI', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'KORSPRI', 'unit' => 'KORSPRI', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // YANMA - ALKOM (Slide 44)
            ['org' => 'YANMA', 'unit' => 'YANMA', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            
            // SETUM - ALKOM (Slide 45) - No data
            
            // POLRESTA JAMBI - ALKOM (Slide 46-47)
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2004, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2013, 'condition' => 'BB', 'qty' => 11],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2023, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2013, 'condition' => 'BB', 'qty' => 11],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 11],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 173],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 16],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 100],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 200],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 15],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'RGU', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'REPAIR VAN', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES MUARO JAMBI - WILAYAH (Slide 47)
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2003, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 10],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 8],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2017, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2012, 'condition' => 'BB', 'qty' => 20],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 100],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 15],
            ['org' => 'POLRES MUARO JAMBI', 'unit' => 'Polres Muaro Jambi', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES TANJAB BARAT - WILAYAH (Slide 48)
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2015, 'condition' => 'BB', 'qty' => 5],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 6],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 4],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 80],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 10],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 35],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 100],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 12],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES TANJAB TIMUR - WILAYAH (Slide 49)
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 11],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 12],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 125],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 65],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 17],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES BATANGHARI - WILAYAH (Slide 50)
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'RR', 'qty' => 3],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 9],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 8],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 25],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'RR', 'qty' => 15],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 10],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 60],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 75],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 14],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES SAROLANGUN - WILAYAH (Slide 51)
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2015, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 4],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 10],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 100],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 25],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 100],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 16],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES MERANGIN - WILAYAH (Slide 52)
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2016, 'condition' => 'RR', 'qty' => 2],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2015, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 10],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 4],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 30],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 65],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 23],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => null, 'equipment' => 'RGU', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES BUNGO - WILAYAH (Slide 53)
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2004, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2016, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2019, 'condition' => 'BB', 'qty' => 3],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 12],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 11],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 5],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 40],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 60],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 10],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 75],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 100],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 18],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => null, 'equipment' => 'RGU', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES TEBO - WILAYAH (Slide 54)
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2004, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2015, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2016, 'condition' => 'RR', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 6],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 13],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 7],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 150],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 18],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'RB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES KERINCI - WILAYAH (Slide 55)
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2004, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'REPEATER', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2016, 'condition' => 'BB', 'qty' => 10],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'RADIO FIXED', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 11],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 6],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'RADIO MOBILE', 'year' => 2016, 'condition' => 'BB', 'qty' => 2],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 30],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'HT', 'year' => 2013, 'condition' => 'BB', 'qty' => 9],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 30],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'HT', 'year' => 2015, 'condition' => 'BB', 'qty' => 55],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'HT', 'year' => 2016, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'HT', 'year' => 2017, 'condition' => 'BB', 'qty' => 50],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'ANDROID', 'year' => 2023, 'condition' => 'BB', 'qty' => 15],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'ROUTER CCGW/VPN-IP', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => null, 'equipment' => 'RGU', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            
            // TOWER DATA (Slides 60-67)
            // POLRES TANJAB BARAT
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => 'Site Polres Tanjab Barat', 'equipment' => 'TOWER SST 72 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Bukit Tambi', 'equipment' => 'TOWER SST 105 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Kuala Tungkal', 'equipment' => 'TOWER SST 72 M', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB BARAT', 'unit' => 'Polres Tanjab Barat', 'site' => 'Site Kompi Brimob Betara', 'equipment' => 'TOWER SST 72 M', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES TANJAB TIMUR
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => 'Site Muara Sabak', 'equipment' => 'TOWER SST 85 M', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TANJAB TIMUR', 'unit' => 'Polres Tanjab Timur', 'site' => 'Site Muara Sabak', 'equipment' => 'TOWER SST 72 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES BATANGHARI
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => 'Site Polres Batanghari', 'equipment' => 'TOWER SST 92 M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => 'Site Pemayung', 'equipment' => 'TOWER SST 72 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BATANGHARI', 'unit' => 'Polres Batanghari', 'site' => 'Site Muara Tembesi', 'equipment' => 'TOWER SST 92 M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Bukit Paku', 'equipment' => 'TOWER SST 85 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES SAROLANGUN
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => 'Site Polsek Mandiangin', 'equipment' => 'TOWER SST 92 M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => 'Site Polres Sarolangun', 'equipment' => 'TOWER SST 42 M', 'year' => 2015, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES SAROLANGUN', 'unit' => 'Polres Sarolangun', 'site' => 'Site Polsekta Sarolangun', 'equipment' => 'TOWER SST 72 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Pauh', 'equipment' => 'TOWER SST 85 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Bukit Pedukuh', 'equipment' => 'TOWER SST 85 M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site TVRI Sarolangun', 'equipment' => 'TOWER SST 52 M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Indosat Pauh', 'equipment' => 'TOWER SST 72 M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES MERANGIN
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => 'Site Polsek Pamenang', 'equipment' => 'TOWER SST 72 M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => 'Site Sungai Ulak Bangko', 'equipment' => 'TOWER SST 72 M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => 'Site Polsek Tabir', 'equipment' => 'TOWER SST 72 M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES MERANGIN', 'unit' => 'Polres Merangin', 'site' => 'Site Yon B Brimob Pamenang', 'equipment' => 'TOWER SST 72 M', 'year' => 2019, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Bangko', 'equipment' => 'TOWER SST 85 M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES BUNGO
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Tanah Sepenggal Lintas', 'equipment' => 'TOWER GWT 52 M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Polsek Pelepat', 'equipment' => 'TOWER SST 42 M', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Sat Lantas Polres Bungo', 'equipment' => 'TOWER SST 42 M', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Polsek Pelayang', 'equipment' => 'TOWER SST 42 M', 'year' => 2023, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES BUNGO', 'unit' => 'Polres Bungo', 'site' => 'Site Polsek Mestoliq', 'equipment' => 'TOWER GWT 52 M', 'year' => 2006, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Muara Bungo', 'equipment' => 'TOWER SST 95 M', 'year' => 2003, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Kuamang Kuning', 'equipment' => 'TOWER SST 72 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES TEBO
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => 'Site Polres Tebo', 'equipment' => 'TOWER SST 72 M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRES TEBO', 'unit' => 'Polres Tebo', 'site' => 'Site Polsek Tebo Ilir', 'equipment' => 'TOWER SST 72 M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Muara Tebo', 'equipment' => 'TOWER SST 52 M', 'year' => 2003, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Rimbo Bujang', 'equipment' => 'TOWER SST 42 M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            
            // POLRES KERINCI
            ['org' => 'POLRES KERINCI', 'unit' => 'Polres Kerinci', 'site' => 'Site Polres Kerinci', 'equipment' => 'TOWER SST 72 M', 'year' => 2016, 'condition' => 'BB', 'qty' => 1],
            
            // POLDA JAMBI & POLRESTA (Additional)
            ['org' => 'POLDA JAMBI', 'unit' => 'Site Polda Jambi', 'site' => 'Site Polda Jambi', 'equipment' => 'TOWER SST 42 M', 'year' => 1998, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => 'Site Polsekta Kotabaru', 'equipment' => 'TOWER SST 72 M', 'year' => 2013, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLRESTA JAMBI', 'unit' => 'Polresta Jambi', 'site' => 'Site Polres Muaro Jambi', 'equipment' => 'TOWER SST 72 M', 'year' => 2007, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Jauko', 'equipment' => 'TOWER SST 72 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
            ['org' => 'POLDA JAMBI', 'unit' => 'Bid TIK', 'site' => 'Site Telkom Mendalo', 'equipment' => 'TOWER SST 52 M', 'year' => 2017, 'condition' => 'BB', 'qty' => 1],
        ];

        foreach ($data as $item) {
            // Determine category based on equipment name
            $category = 'REPEATER'; // default
            $equipmentName = strtoupper($item['equipment']);
            
            if (strpos($equipmentName, 'TOWER') !== false) {
                $category = 'TOWER';
            } elseif (strpos($equipmentName, 'SHELTER') !== false) {
                $category = 'SHELTER';
            } elseif (strpos($equipmentName, 'RGU') !== false) {
                $category = 'RGU';
            } elseif (strpos($equipmentName, 'REPAIR VAN') !== false || strpos($equipmentName, 'VAN') !== false) {
                $category = 'REPAIR VAN';
            } elseif (strpos($equipmentName, 'ROUTER') !== false || strpos($equipmentName, 'CCGW') !== false) {
                $category = 'ROUTER';
            } elseif (strpos($equipmentName, 'RADIO FIXED') !== false || strpos($equipmentName, 'FIXED') !== false) {
                $category = 'RADIO FIXED';
            } elseif (strpos($equipmentName, 'RADIO MOBILE') !== false || strpos($equipmentName, 'MOBILE') !== false) {
                $category = 'RADIO MOBILE';
            } elseif (strpos($equipmentName, 'HT') !== false) {
                $category = 'HT';
            } elseif (strpos($equipmentName, 'ANDROID') !== false || strpos($equipmentName, 'LEX') !== false || strpos($equipmentName, 'TELEPON') !== false) {
                $category = 'ANDROID';
            }
            
            // Get or create equipment type
            $equipmentType = EquipmentType::firstOrCreate(
                ['name' => $item['equipment']],
                [
                    'category' => $category,
                    'is_active' => true
                ]
            );

            // Get organization using mapping
            $organizationName = $organizationMapping[$item['org']] ?? $item['org'];
            $organization = Organization::where('name', $organizationName)->first();
            
            if (!$organization) {
                echo "Organization not found: {$item['org']} (mapped to: {$organizationName})\n";
                continue;
            }

            // Get site by name (remove SST height info for matching)
            $site = null;
            if ($item['site'] !== null) {
                $siteName = preg_replace('/\s+(SST|GWT)\s+\d+\s*M$/i', '', $item['site']);
                $site = Site::where('name', 'like', '%' . $siteName . '%')->first();
            }

            // Create inventory
            Inventory::create([
                'organization_id' => $organization->id,
                'unit' => $item['unit'],
                'site_id' => $site?->id,
                'equipment_type_id' => $equipmentType->id,
                'installation_year' => $item['year'],
                'condition' => $item['condition'],
                'quantity' => $item['qty'],
                'is_active' => true,
            ]);
        }
        
        echo "Data berhasil diimport!\n";
    }
}
