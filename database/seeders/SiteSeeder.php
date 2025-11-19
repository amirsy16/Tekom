<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Site untuk POLDA JAMBI
        Site::create([
            'name' => 'Site Polda Jambi',
            'location' => 'Polda Jambi',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 42 M',
            'description' => 'Site komunikasi utama Polda Jambi',
            'is_active' => true,
        ]);

        // Site untuk POLRESTA JAMBI
        Site::create([
            'name' => 'Site Polsekta Kotabaru',
            'location' => 'Polsekta Kotabaru',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi Polresta Jambi',
            'is_active' => true,
        ]);

        // Site untuk SAT BRIMOB
        Site::create([
            'name' => 'Site Brimob 1',
            'location' => 'Sat Brimob Polda Jambi',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi Sat Brimob tower 1',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Brimob 2',
            'location' => 'Sat Brimob Polda Jambi',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi Sat Brimob tower 2',
            'is_active' => true,
        ]);

        // Sites untuk POLRES MUARO JAMBI
        Site::create([
            'name' => 'Site Polres Muaro Jambi',
            'location' => 'Polres Muaro Jambi',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site utama Polres Muaro Jambi',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Sekernan',
            'location' => 'Sekernan',
            'ownership' => 'TELKOM',
            'tower_height' => 'GWT 52 M',
            'description' => 'Site komunikasi area Sekernan',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Bahar Selatan',
            'location' => 'Bahar Selatan',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi area Bahar Selatan',
            'is_active' => true,
        ]);

        // Sites untuk POLRES TANJAB BARAT
        Site::create([
            'name' => 'Site Polres Tanjab Barat',
            'location' => 'Polres Tanjab Barat',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site utama Polres Tanjab Barat',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Senyerang',
            'location' => 'Senyerang',
            'ownership' => 'TELKOM',
            'tower_height' => 'SST 105 M',
            'description' => 'Site komunikasi area Senyerang',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Betara',
            'location' => 'Betara',
            'ownership' => 'TELKOM',
            'tower_height' => 'SST 85 M',
            'description' => 'Site komunikasi area Betara',
            'is_active' => true,
        ]);

        // Sites untuk POLRES TANJAB TIMUR
        Site::create([
            'name' => 'Site Polres Tanjab Timur',
            'location' => 'Polres Tanjab Timur',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site utama Polres Tanjab Timur',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Muara Sabak',
            'location' => 'Muara Sabak',
            'ownership' => 'TELKOM',
            'tower_height' => 'SST 85 M',
            'description' => 'Site komunikasi area Muara Sabak',
            'is_active' => true,
        ]);

        // Sites untuk POLRES BATANGHARI
        Site::create([
            'name' => 'Site Polres Batanghari',
            'location' => 'Polres Batanghari',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site utama Polres Batanghari',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Muara Bulian',
            'location' => 'Muara Bulian',
            'ownership' => 'TELKOM',
            'tower_height' => 'SST 85 M',
            'description' => 'Site komunikasi area Muara Bulian',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Mersam',
            'location' => 'Mersam',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 92 M',
            'description' => 'Site komunikasi area Mersam',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Pemayung',
            'location' => 'Pemayung',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 92 M',
            'description' => 'Site komunikasi area Pemayung',
            'is_active' => true,
        ]);

        // Sites untuk POLRES SAROLANGUN
        Site::create([
            'name' => 'Site Polres Sarolangun',
            'location' => 'Polres Sarolangun',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 42 M',
            'description' => 'Site utama Polres Sarolangun',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Limun',
            'location' => 'Limun',
            'ownership' => 'TELKOM',
            'tower_height' => 'SST 85 M',
            'description' => 'Site komunikasi area Limun',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Pelawan',
            'location' => 'Pelawan',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 95 M',
            'description' => 'Site komunikasi area Pelawan',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Pauh',
            'location' => 'Pauh',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi area Pauh',
            'is_active' => true,
        ]);

        // Sites untuk POLRES MERANGIN
        Site::create([
            'name' => 'Site Polres Merangin',
            'location' => 'Polres Merangin',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site utama Polres Merangin',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Bangko',
            'location' => 'Bangko',
            'ownership' => 'TELKOM',
            'tower_height' => 'SST 85 M',
            'description' => 'Site komunikasi area Bangko',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Jangkat',
            'location' => 'Jangkat',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi area Jangkat',
            'is_active' => true,
        ]);

        // Sites untuk POLRES BUNGO
        Site::create([
            'name' => 'Site Polres Bungo',
            'location' => 'Polres Bungo',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 42 M',
            'description' => 'Site utama Polres Bungo',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Muara Bungo',
            'location' => 'Muara Bungo',
            'ownership' => 'TELKOM',
            'tower_height' => 'GWT 52 M',
            'description' => 'Site komunikasi area Muara Bungo',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Rimbo Bujang',
            'location' => 'Rimbo Bujang',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 95 M',
            'description' => 'Site komunikasi area Rimbo Bujang',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Jujuhan',
            'location' => 'Jujuhan',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi area Jujuhan',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Pelepat',
            'location' => 'Pelepat',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi area Pelepat',
            'is_active' => true,
        ]);

        // Sites untuk POLRES TEBO
        Site::create([
            'name' => 'Site Polres Tebo',
            'location' => 'Polres Tebo',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 42 M',
            'description' => 'Site utama Polres Tebo',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Muara Tebo',
            'location' => 'Muara Tebo',
            'ownership' => 'TELKOM',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi area Muara Tebo',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Rimbo Bujang Tebo',
            'location' => 'Rimbo Bujang',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi area Rimbo Bujang Tebo',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Rimbo Ulu',
            'location' => 'Rimbo Ulu',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 42 M',
            'description' => 'Site komunikasi area Rimbo Ulu',
            'is_active' => true,
        ]);

        // Site untuk POLRES KERINCI
        Site::create([
            'name' => 'Site Polres Kerinci',
            'location' => 'Polres Kerinci',
            'ownership' => 'POLRI',
            'tower_height' => 'SST 72 M',
            'description' => 'Site utama Polres Kerinci',
            'is_active' => true,
        ]);

        // Additional sites berdasarkan data tower
        Site::create([
            'name' => 'Site TVRI',
            'location' => 'TVRI Jambi',
            'ownership' => 'TVRI',
            'tower_height' => 'SST 52 M',
            'description' => 'Site komunikasi TVRI',
            'is_active' => true,
        ]);

        Site::create([
            'name' => 'Site Indosat',
            'location' => 'Indosat Tower',
            'ownership' => 'INDOSAT',
            'tower_height' => 'SST 72 M',
            'description' => 'Site komunikasi Indosat',
            'is_active' => true,
        ]);
    }
}