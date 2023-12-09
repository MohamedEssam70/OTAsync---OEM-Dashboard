<?php

namespace Database\Seeders;

use App\Models\MacModels;
use App\Models\MacTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MacModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop all rows
        MacModels::truncate();
        
        // Create Main Countries
        MacModels::create([
            'mac_id' => MacTypes::all()->random()->id,
            'name'=>'Model01',
            'serial' => 'M12v008',
        ]);
        MacModels::create([
            'mac_id' => MacTypes::all()->random()->id,
            'name'=>'Model02',
            'serial' => 'M23v036',
        ]);

        // Create Randowm Countries
        // MacModels::factory(3)->create();

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
