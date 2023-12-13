<?php

namespace Database\Seeders;

use App\Models\Ecus;
use App\Models\MacModels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EcusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop all rows
        Ecus::truncate();
        
        // Create Main Countries
        Ecus::create([
            'model' => MacModels::all()->random()->id,
            'name'=>'ECU 01',
            'app'=>'Engine',
            'controller' => 'STM32',
            'software_version' => 'fw012xd05',
            'manufactor_hw_number' => 'F401RCTB',
            'serial' => '0x08001290',
            'VIN' => '',
            'flash_size' => '256',
        ]);

        // Create Randowm Countries
        // Ecus::factory(3)->create();

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
