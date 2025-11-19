<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // POLDA JAMBI sebagai parent
        $polda = Organization::create([
            'code' => 'POLDA_JBI',
            'name' => 'Polda Jambi',
            'type' => 'POLDA',
            'parent_id' => null,
            'address' => 'Jambi',
            'is_active' => true,
        ]);

        // Bidang-bidang di POLDA
        $bidTik = Organization::create([
            'code' => 'BID_TIK',
            'name' => 'Bidang Teknologi Informasi dan Komunikasi',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $satBrimob = Organization::create([
            'code' => 'SAT_BRIMOB',
            'name' => 'Satuan Brimob',
            'type' => 'SATUAN',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $ditlantas = Organization::create([
            'code' => 'LANTAS',
            'name' => 'Direktorat Lalu Lintas',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $ditsabhara = Organization::create([
            'code' => 'SABHARA',
            'name' => 'Direktorat Samapta Bhayangkara',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $ditintelkam = Organization::create([
            'code' => 'INTELKAM',
            'name' => 'Direktorat Intelijen Keamanan',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $ditreskrimum = Organization::create([
            'code' => 'RESKRIMUM',
            'name' => 'Direktorat Reserse Kriminal Umum',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $ditreskrimsus = Organization::create([
            'code' => 'RESKRIMSUS',
            'name' => 'Direktorat Reserse Kriminal Khusus',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $ditresnarkoba = Organization::create([
            'code' => 'RESNARKOB',
            'name' => 'Direktorat Reserse Narkoba',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $ditpamobvit = Organization::create([
            'code' => 'PAMOBVIT',
            'name' => 'Direktorat Pengamanan Objek Vital',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        $ditpolair = Organization::create([
            'code' => 'POLAIR',
            'name' => 'Direktorat Polair',
            'type' => 'BIDANG',
            'parent_id' => $polda->id,
            'address' => 'Polda Jambi',
            'is_active' => true,
        ]);

        // POLRESTA dan POLRES
        Organization::create([
            'code' => 'RESTA_JBI',
            'name' => 'Polresta Jambi',
            'type' => 'POLRESTA',
            'parent_id' => $polda->id,
            'address' => 'Kota Jambi',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_MUARO',
            'name' => 'Polres Muaro Jambi',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Muaro Jambi',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_TAJAB',
            'name' => 'Polres Tanjung Jabung Barat',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Tanjung Jabung Barat',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_TAJAT',
            'name' => 'Polres Tanjung Jabung Timur',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Tanjung Jabung Timur',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_BATANG',
            'name' => 'Polres Batanghari',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Batanghari',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_SAROLA',
            'name' => 'Polres Sarolangun',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Sarolangun',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_MERANG',
            'name' => 'Polres Merangin',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Merangin',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_BUNGO',
            'name' => 'Polres Bungo',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Bungo',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_TEBO',
            'name' => 'Polres Tebo',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Tebo',
            'is_active' => true,
        ]);

        Organization::create([
            'code' => 'RES_KERIN',
            'name' => 'Polres Kerinci',
            'type' => 'POLRES',
            'parent_id' => $polda->id,
            'address' => 'Kerinci',
            'is_active' => true,
        ]);
    }
}