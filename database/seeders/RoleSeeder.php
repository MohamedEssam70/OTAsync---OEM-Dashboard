<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop all rows
        Role::truncate();
        
        // Create Main Countries
        Role::create([
            'role_id'=> 1,
            'title'=>'Embedded Systems Engineer'
        ]);
        Role::create([
            'role_id'=> 2,
            'title'=>'Software Engineer'
        ]);
        Role::create([
            'role_id'=> 3,
            'title'=>'Team Leader'
        ]);
        Role::create([
            'role_id'=> 4,
            'title'=>'Senior Software Tester'
        ]);
        Role::create([
            'role_id'=> 5,
            'title'=>'CEO'
        ]);

        // Create Randowm Countries
        // Role::factory(3)->create();

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
