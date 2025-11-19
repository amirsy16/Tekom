<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EquipmentType;

class EquipmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // REPEATER Equipment Types
        EquipmentType::create([
            'name' => 'GTR8000',
            'category' => 'REPEATER',
            'brand' => 'Motorola',
            'specifications' => 'Digital Trunking Repeater, 800 MHz band',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'GTR800',
            'category' => 'REPEATER',
            'brand' => 'Motorola',
            'specifications' => 'Digital Trunking Repeater, 800 MHz band',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'MX800',
            'category' => 'REPEATER',
            'brand' => 'Motorola',
            'specifications' => 'Conventional Repeater, 800 MHz band',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'MTR3000',
            'category' => 'REPEATER',
            'brand' => 'Motorola',
            'specifications' => 'Digital/Analog Repeater, 800 MHz band',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'QUANTAR',
            'category' => 'REPEATER',
            'brand' => 'Motorola',
            'specifications' => 'Analog Repeater, 800 MHz band',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'KENWOOD REPEATER',
            'category' => 'REPEATER',
            'brand' => 'Kenwood',
            'specifications' => 'Analog Repeater, 800 MHz band',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'MSO TRUNKING',
            'category' => 'TRUNKING',
            'brand' => 'Motorola',
            'specifications' => 'Master Site Office for Trunking System',
            'warranty_months' => 36,
            'is_active' => true,
        ]);

        // RADIO FIXED Equipment Types
        EquipmentType::create([
            'name' => 'CDM1250',
            'category' => 'RADIO_FIXED',
            'brand' => 'Motorola',
            'specifications' => 'Mobile Radio for Fixed Installation',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'CDM1550',
            'category' => 'RADIO_FIXED',
            'brand' => 'Motorola',
            'specifications' => 'Digital Mobile Radio for Fixed Installation',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'XTL2500',
            'category' => 'RADIO_FIXED',
            'brand' => 'Motorola',
            'specifications' => 'Digital Trunking Mobile Radio for Fixed Installation',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        // RADIO MOBILE Equipment Types
        EquipmentType::create([
            'name' => 'XTL2500 MOBILE',
            'category' => 'RADIO_MOBILE',
            'brand' => 'Motorola',
            'specifications' => 'Digital Trunking Mobile Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'CDM1250 MOBILE',
            'category' => 'RADIO_MOBILE',
            'brand' => 'Motorola',
            'specifications' => 'Analog Mobile Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'CDM1550 MOBILE',
            'category' => 'RADIO_MOBILE',
            'brand' => 'Motorola',
            'specifications' => 'Digital Mobile Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'APX6500',
            'category' => 'RADIO_MOBILE',
            'brand' => 'Motorola',
            'specifications' => 'Digital P25 Mobile Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        // HANDY TALKY Equipment Types
        EquipmentType::create([
            'name' => 'XTS2500',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Digital Trunking Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'XTS5000',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Digital Trunking Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'APX6000',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Digital P25 Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'APX7000',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Digital P25 Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'APX8000',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Digital P25 Portable Radio with GPS',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'CP1300',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Digital Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'CP1660',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Digital Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'GP328',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Analog Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'GP338',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Analog Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'CP200',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Analog Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'LEX L11',
            'category' => 'HANDY_TALKY',
            'brand' => 'Motorola',
            'specifications' => 'Android-based Smart Radio with LEX application',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'KENWOOD HT',
            'category' => 'HANDY_TALKY',
            'brand' => 'Kenwood',
            'specifications' => 'Analog Portable Radio',
            'warranty_months' => 12,
            'is_active' => true,
        ]);

        // ROUTER & NETWORK Equipment Types
        EquipmentType::create([
            'name' => 'CCGW ROUTER',
            'category' => 'ROUTER',
            'brand' => 'Various',
            'specifications' => 'Common Control Gateway Router',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'VPN ROUTER',
            'category' => 'ROUTER',
            'brand' => 'Various',
            'specifications' => 'VPN Gateway Router',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'RGU',
            'category' => 'NETWORK',
            'brand' => 'Various',
            'specifications' => 'Radio Gateway Unit',
            'warranty_months' => 24,
            'is_active' => true,
        ]);

        // TOWER & INFRASTRUCTURE Equipment Types
        EquipmentType::create([
            'name' => 'SST TOWER',
            'category' => 'TOWER',
            'brand' => 'Various',
            'specifications' => 'Self Supporting Tower',
            'warranty_months' => 60,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'GWT TOWER',
            'category' => 'TOWER',
            'brand' => 'Various',
            'specifications' => 'Guyed Wire Tower',
            'warranty_months' => 60,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'SHELTER 3X3',
            'category' => 'SHELTER',
            'brand' => 'Various',
            'specifications' => '3M x 3M Communication Shelter',
            'warranty_months' => 36,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'SHELTER 3X4',
            'category' => 'SHELTER',
            'brand' => 'Various',
            'specifications' => '3M x 4M Communication Shelter',
            'warranty_months' => 36,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'SHELTER 4X6',
            'category' => 'SHELTER',
            'brand' => 'Various',
            'specifications' => '4M x 6M Communication Shelter',
            'warranty_months' => 36,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'SHELTER 4X8',
            'category' => 'SHELTER',
            'brand' => 'Various',
            'specifications' => '4M x 8M Communication Shelter',
            'warranty_months' => 36,
            'is_active' => true,
        ]);

        EquipmentType::create([
            'name' => 'REPAIR VAN',
            'category' => 'VEHICLE',
            'brand' => 'Various',
            'specifications' => 'Mobile Communication Repair Vehicle',
            'warranty_months' => 12,
            'is_active' => true,
        ]);
    }
}