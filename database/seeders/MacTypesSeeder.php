<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MacTypes;
use Illuminate\Support\Facades\DB;

class MacTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop all rows
        MacTypes::truncate();
        
        // Create Main Countries
        MacTypes::create([
            'name'=>'Vehicle'
        ]);

        // Create Randowm Countries
        // MacTypes::factory(3)->create();

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
