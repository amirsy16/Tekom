<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@polda-jambi.go.id',
        ]);
        
        // Seed ALKOM data from HTML file - comprehensive data
        $this->call([
            OrganizationSeeder::class,
            SiteTowerSeeder::class,
            EquipmentTypeSeeder::class,
            InventorySeeder::class,
        ]);
    }
}
