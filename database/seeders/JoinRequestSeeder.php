<?php

namespace Database\Seeders;

use App\Models\JoinRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class JoinRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop all rows
        JoinRequest::truncate();
        
        // Create Main Users
        // JoinRequest::create([
        //     'firstname' => 'Mohamed',
        //     'lastname' => 'Essam',
        //     'email' => 'mohamedessam.engineer@gmail.com',
        //     'email_verified_at' => now(),
        //     'phone' => '150705858',
        //     'password' => Hash::make('00114477'),
        //     'remember_token' => Str::random(10),
        //     'role_id' => 5,
        //     'avatar' => 'mohamed.jpg',
        //     'city' => 'Cairo',
        //     'zip' =>  234568,
        //     'address' => '34 Mustafa Hafeth - Helwan'
        // ]);

        // Create Randowm Users
        JoinRequest::factory(10)->create();

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
