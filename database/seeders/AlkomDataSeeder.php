<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Site;
use App\Models\EquipmentType;
use App\Models\Inventory;
use Illuminate\Database\Seeder;

class AlkomDataSeeder extends Seeder
{
    public function run()
    {
        // Create Organizations
        $organizations = $this->createOrganizations();
        
        // Create Equipment Types
        $equipmentTypes = $this->createEquipmentTypes();
        
        // Create Sites
        $sites = $this->createSites($organizations);
        
        // Create Inventory
        $this->createInventory($organizations, $sites, $equipmentTypes);
        
        $this->command->info('ALKOM data seeded successfully!');
    }
    
    protected function createOrganizations()
    {
        $orgData = [
            ['code' => 'POLDA', 'name' => 'POLDA JAMBI', 'type' => 'POLDA'],
            ['code' => 'RESTA', 'name' => 'POLRESTA JAMBI', 'type' => 'POLRESTA'],
            ['code' => 'MUARJA', 'name' => 'POLRES MUARO JAMBI', 'type' => 'POLRES'],
            ['code' => 'TANJAB', 'name' => 'POLRES TANJAB BARAT', 'type' => 'POLRES'],
            ['code' => 'TANJABT', 'name' => 'POLRES TANJAB TIMUR', 'type' => 'POLRES'],
            ['code' => 'BATANG', 'name' => 'POLRES BATANGHARI', 'type' => 'POLRES'],
            ['code' => 'SAROL', 'name' => 'POLRES SAROLANGUN', 'type' => 'POLRES'],
            ['code' => 'MERANG', 'name' => 'POLRES MERANGIN', 'type' => 'POLRES'],
            ['code' => 'BUNGO', 'name' => 'POLRES BUNGO', 'type' => 'POLRES'],
            ['code' => 'TEBO', 'name' => 'POLRES TEBO', 'type' => 'POLRES'],
            ['code' => 'KERINCI', 'name' => 'POLRES KERINCI', 'type' => 'POLRES'],
            ['code' => 'BRIMOB', 'name' => 'SAT BRIMOB POLDA JAMBI', 'type' => 'SATUAN'],
            ['code' => 'BIDTIK', 'name' => 'BID TIK POLDA JAMBI', 'type' => 'BIDANG'],
        ];
        
        $organizations = [];
        foreach ($orgData as $data) {
            $organizations[$data['code']] = Organization::create([
                'code' => $data['code'],
                'name' => $data['name'],
                'type' => $data['type'],
                'address' => 'Jambi',
                'is_active' => true,
            ]);
        }
        
        return $organizations;
    }
    
    protected function createEquipmentTypes()
    {
        $equipmentData = [
            // Repeaters
            ['name' => 'GTR800 + MSO TRUNKING', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            ['name' => 'KOMOB RPT GTR8000', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            ['name' => 'KOMOB RPT 8X800', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            ['name' => 'MX800', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            ['name' => 'QUANTAR', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            ['name' => 'GTR8000', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            ['name' => 'GTR 8000 6 CHANEL (TRUNKING)', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            ['name' => 'KENWOOD', 'category' => 'REPEATER', 'brand' => 'KENWOOD'],
            ['name' => 'MTR3000', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            ['name' => 'GTR8000 Trunking 4 Chanel', 'category' => 'REPEATER', 'brand' => 'MOTOROLA'],
            
            // Radio Fixed
            ['name' => 'APX2500', 'category' => 'RADIO_FIXED', 'brand' => 'MOTOROLA'],
            ['name' => 'XTL2500', 'category' => 'RADIO_MOBILE', 'brand' => 'MOTOROLA'],
            
            // Handy Talkie
            ['name' => 'XTS2500', 'category' => 'HANDY_TALKIE', 'brand' => 'MOTOROLA'],
            ['name' => 'XTS500', 'category' => 'HANDY_TALKIE', 'brand' => 'MOTOROLA'],
            ['name' => 'APX1000', 'category' => 'HANDY_TALKIE', 'brand' => 'MOTOROLA'],
            ['name' => 'ATS2500', 'category' => 'HANDY_TALKIE', 'brand' => 'MOTOROLA'],
            ['name' => 'XLR2500', 'category' => 'HANDY_TALKIE', 'brand' => 'MOTOROLA'],
            ['name' => 'LEX 11', 'category' => 'HANDY_TALKIE', 'brand' => 'ANDROID'],
            
            // Links
            ['name' => 'RADIO LINK APX2500', 'category' => 'RADIO_LINK', 'brand' => 'MOTOROLA'],
            ['name' => 'Microwave Link', 'category' => 'MICROWAVE_LINK', 'brand' => 'INDOSAT'],
        ];
        
        $equipmentTypes = [];
        foreach ($equipmentData as $data) {
            $equipmentTypes[$data['name']] = EquipmentType::create([
                'name' => $data['name'],
                'category' => $data['category'],
                'brand' => $data['brand'],
                'specifications' => 'Imported from ALKOM data',
                'warranty_months' => 12,
                'is_active' => true,
            ]);
        }
        
        return $equipmentTypes;
    }
    
    protected function createSites($organizations)
    {
        $siteData = [
            ['name' => 'Site Polda Jambi SST 42 M', 'org' => 'POLDA', 'height' => 42, 'ownership' => 'POLRI'],
            ['name' => 'Site Polsekta Kotabaru SST 72 M', 'org' => 'RESTA', 'height' => 72, 'ownership' => 'POLRI'],
            ['name' => 'Site Polres Muaro Jambi SST 72 M', 'org' => 'MUARJA', 'height' => 72, 'ownership' => 'POLRI'],
            ['name' => 'Site Jaluko SST 72 M', 'org' => 'MUARJA', 'height' => 72, 'ownership' => 'POLRI'],
            ['name' => 'Site Telkom Mendalo SST 52 M', 'org' => 'MUARJA', 'height' => 52, 'ownership' => 'TELKOM'],
            ['name' => 'Site Polsek Mestong GWT 52 M', 'org' => 'MUARJA', 'height' => 52, 'ownership' => 'POLRI'],
            ['name' => 'Site Polres Tanjab Barat SST 72 M', 'org' => 'TANJAB', 'height' => 72, 'ownership' => 'POLRI'],
            ['name' => 'Site Telkom Kuala Tungkal SST 72 M', 'org' => 'TANJAB', 'height' => 72, 'ownership' => 'TELKOM'],
            ['name' => 'Site Telkom Bukit Tambi SST 105 M', 'org' => 'TANJAB', 'height' => 105, 'ownership' => 'TELKOM'],
            ['name' => 'Site Kompi Brimob Betara SST 72 M', 'org' => 'BRIMOB', 'height' => 72, 'ownership' => 'POLRI'],
            ['name' => 'Site Muara Sabak SST 72 M', 'org' => 'TANJABT', 'height' => 72, 'ownership' => 'POLRI'],
            ['name' => 'Site Telkom Muara Sabak SST 85 M', 'org' => 'TANJABT', 'height' => 85, 'ownership' => 'TELKOM'],
            ['name' => 'Site Polres Batanghari SST 92 M', 'org' => 'BATANG', 'height' => 92, 'ownership' => 'POLRI'],
            ['name' => 'Site Pemayung SST 72 M', 'org' => 'BATANG', 'height' => 72, 'ownership' => 'POLRI'],
            ['name' => 'Site Muara Tembesi SST 92 M', 'org' => 'BATANG', 'height' => 92, 'ownership' => 'POLRI'],
            ['name' => 'Site Telkom Bukit Paku SST 85 M', 'org' => 'BATANG', 'height' => 85, 'ownership' => 'TELKOM'],
            ['name' => 'Site Polsek Mandiangin SST 92 M', 'org' => 'SAROL', 'height' => 92, 'ownership' => 'POLRI'],
            ['name' => 'Site Polres Sarolangun SST 42 M', 'org' => 'SAROL', 'height' => 42, 'ownership' => 'POLRI'],
            ['name' => 'Site Polsekta Sarolangun SST 72 M', 'org' => 'SAROL', 'height' => 72, 'ownership' => 'POLRI'],
            ['name' => 'Site Telkom Pauh SST 85 M', 'org' => 'SAROL', 'height' => 85, 'ownership' => 'TELKOM'],
            ['name' => 'Site Telkom Bukit Pedukuh SST 85 M', 'org' => 'SAROL', 'height' => 85, 'ownership' => 'TELKOM'],
            ['name' => 'Site TVRI Sarolangun SST 52 M', 'org' => 'SAROL', 'height' => 52, 'ownership' => 'TVRI'],
            ['name' => 'Site Indosat Pauh SST 72 M', 'org' => 'SAROL', 'height' => 72, 'ownership' => 'INDOSAT'],
        ];
        
        $sites = [];
        foreach ($siteData as $data) {
            $location = $this->extractLocationFromSiteName($data['name']);
            
            $sites[$data['name']] = Site::create([
                'name' => $data['name'],
                'location' => $location,
                'ownership' => $data['ownership'],
                'tower_height' => $data['height'],
                'latitude' => $this->generateRandomLatitude(),
                'longitude' => $this->generateRandomLongitude(),
                'description' => 'Site komunikasi POLDA Jambi',
                'is_active' => true,
            ]);
        }
        
        return $sites;
    }
    
    protected function createInventory($organizations, $sites, $equipmentTypes)
    {
        // Data inventaris berdasarkan CSV
        $inventoryData = [
            // POLDA JAMBI
            ['org' => 'POLDA', 'site' => 'Site Polda Jambi SST 42 M', 'equipment' => 'GTR800 + MSO TRUNKING', 'year' => 2013, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => 'Site Polda Jambi SST 42 M', 'equipment' => 'KOMOB RPT GTR8000', 'year' => 2019, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => 'Site Polda Jambi SST 42 M', 'equipment' => 'KOMOB RPT 8X800', 'year' => 2024, 'qty' => 1, 'condition' => 'BB'],
            
            // POLRESTA JAMBI
            ['org' => 'RESTA', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'MX800', 'year' => 2004, 'qty' => 1, 'condition' => 'RB'],
            ['org' => 'BIDTIK', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'QUANTAR', 'year' => 2006, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BIDTIK', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'GTR8000', 'year' => 2015, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'GTR8000', 'year' => 2019, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BIDTIK', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'GTR 8000 6 CHANEL (TRUNKING)', 'year' => 2013, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BIDTIK', 'site' => 'Site Polsekta Kotabaru SST 72 M', 'equipment' => 'KENWOOD', 'year' => 2016, 'qty' => 1, 'condition' => 'RB'],
            
            // POLRES MUARO JAMBI
            ['org' => 'MUARJA', 'site' => 'Site Polres Muaro Jambi SST 72 M', 'equipment' => 'MX800', 'year' => 2004, 'qty' => 1, 'condition' => 'RB'],
            ['org' => 'MUARJA', 'site' => 'Site Polres Muaro Jambi SST 72 M', 'equipment' => 'GTR8000', 'year' => 2017, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BIDTIK', 'site' => 'Site Polres Muaro Jambi SST 72 M', 'equipment' => 'QUANTAR', 'year' => 2007, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BIDTIK', 'site' => 'Site Polres Muaro Jambi SST 72 M', 'equipment' => 'GTR8000', 'year' => 2016, 'qty' => 1, 'condition' => 'RR'],
            
            ['org' => 'MUARJA', 'site' => 'Site Jaluko SST 72 M', 'equipment' => 'GTR8000', 'year' => 2017, 'qty' => 1, 'condition' => 'RR'],
            ['org' => 'MUARJA', 'site' => 'Site Telkom Mendalo SST 52 M', 'equipment' => 'GTR8000', 'year' => 2017, 'qty' => 1, 'condition' => 'BB'],
            
            ['org' => 'BIDTIK', 'site' => 'Site Polsek Mestong GWT 52 M', 'equipment' => 'QUANTAR', 'year' => 2007, 'qty' => 1, 'condition' => 'RB'],
            ['org' => 'BIDTIK', 'site' => 'Site Polsek Mestong GWT 52 M', 'equipment' => 'GTR8000', 'year' => 2015, 'qty' => 1, 'condition' => 'RR'],
            
            // POLRES TANJAB BARAT
            ['org' => 'BIDTIK', 'site' => 'Site Polres Tanjab Barat SST 72 M', 'equipment' => 'GTR8000 Trunking 4 Chanel', 'year' => 2017, 'qty' => 1, 'condition' => 'RB'],
            ['org' => 'TANJAB', 'site' => 'Site Telkom Kuala Tungkal SST 72 M', 'equipment' => 'GTR8000', 'year' => 2017, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'TANJAB', 'site' => 'Site Telkom Bukit Tambi SST 105 M', 'equipment' => 'MTR3000', 'year' => 2015, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => 'Site Kompi Brimob Betara SST 72 M', 'equipment' => 'GTR8000', 'year' => 2019, 'qty' => 1, 'condition' => 'BB'],
            
            // HT dan Radio untuk berbagai satuan
            ['org' => 'POLDA', 'site' => null, 'equipment' => 'APX2500', 'year' => 2015, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'POLDA', 'site' => null, 'equipment' => 'XTL2500', 'year' => 2013, 'qty' => 2, 'condition' => 'BB'],
            ['org' => 'POLDA', 'site' => null, 'equipment' => 'XTS2500', 'year' => 2013, 'qty' => 2, 'condition' => 'BB'],
            ['org' => 'POLDA', 'site' => null, 'equipment' => 'LEX 11', 'year' => 2023, 'qty' => 2, 'condition' => 'BB'],
            
            ['org' => 'BRIMOB', 'site' => null, 'equipment' => 'XTL2500', 'year' => 2013, 'qty' => 1, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => null, 'equipment' => 'APX2500', 'year' => 2019, 'qty' => 11, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => null, 'equipment' => 'APX2500', 'year' => 2019, 'qty' => 8, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => null, 'equipment' => 'ATS2500', 'year' => 2012, 'qty' => 91, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => null, 'equipment' => 'XTS2500', 'year' => 2013, 'qty' => 36, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => null, 'equipment' => 'APX1000', 'year' => 2015, 'qty' => 216, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => null, 'equipment' => 'XLR2500', 'year' => 2021, 'qty' => 9, 'condition' => 'BB'],
            ['org' => 'BRIMOB', 'site' => null, 'equipment' => 'LEX 11', 'year' => 2023, 'qty' => 2, 'condition' => 'BB'],
        ];
        
        foreach ($inventoryData as $data) {
            $organization = $organizations[$data['org']];
            $site = $data['site'] ? $sites[$data['site']] ?? null : null;
            $equipmentType = $equipmentTypes[$data['equipment']] ?? null;
            
            if ($organization && $equipmentType) {
                Inventory::create([
                    'organization_id' => $organization->id,
                    'site_id' => $site?->id,
                    'equipment_type_id' => $equipmentType->id,
                    'serial_number' => $this->generateSerialNumber($data['equipment'], $data['year']),
                    'installation_year' => $data['year'],
                    'condition' => $data['condition'],
                    'quantity' => $data['qty'],
                    'purchase_price' => $this->estimatePrice($data['equipment']),
                    'notes' => 'Data ALKOM POLDA Jambi',
                    'is_active' => true,
                ]);
            }
        }
    }
    
    protected function extractLocationFromSiteName($siteName)
    {
        // Extract location from site name
        $siteName = str_replace(['Site ', 'site '], '', $siteName);
        $siteName = preg_replace('/\s+(SST|GWT)\s+\d+\s*M/i', '', $siteName);
        $siteName = preg_replace('/^(Polda|Polres|Polsek|Polsekta|Telkom|TVRI|Indosat|Kompi Brimob)\s+/i', '', $siteName);
        
        return trim($siteName);
    }
    
    protected function generateRandomLatitude()
    {
        // Generate latitude around Jambi area (-1.6 to -2.6)
        return -1.6 - (mt_rand(0, 1000) / 1000);
    }
    
    protected function generateRandomLongitude()
    {
        // Generate longitude around Jambi area (103.0 to 104.5)
        return 103.0 + (mt_rand(0, 1500) / 1000);
    }
    
    protected function generateSerialNumber($equipmentName, $year)
    {
        $prefix = strtoupper(substr(str_replace(' ', '', $equipmentName), 0, 3));
        $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        return "{$prefix}-{$year}-{$random}";
    }
    
    protected function estimatePrice($equipmentName)
    {
        // Estimate price based on equipment type
        $priceMap = [
            'GTR8000' => 150000000, // 150 juta
            'GTR800' => 200000000,  // 200 juta
            'MX800' => 120000000,   // 120 juta
            'QUANTAR' => 180000000, // 180 juta
            'MTR3000' => 160000000, // 160 juta
            'APX2500' => 25000000,  // 25 juta
            'XTL2500' => 20000000,  // 20 juta
            'XTS2500' => 8000000,   // 8 juta
            'APX1000' => 6000000,   // 6 juta
            'LEX 11' => 5000000,    // 5 juta
        ];
        
        foreach ($priceMap as $key => $price) {
            if (strpos($equipmentName, $key) !== false) {
                return $price;
            }
        }
        
        return 10000000; // Default 10 juta
    }
}