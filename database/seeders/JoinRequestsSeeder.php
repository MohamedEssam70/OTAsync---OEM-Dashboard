<?php

namespace Database\Seeders;

use App\Models\JoinRequests;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class JoinRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop all rows
        JoinRequests::truncate();
        
        // Create User Request
        JoinRequests::create([
            'firstname' => 'Mohamed',
            'lastname' => 'Ali',
            'email' => 'mohamedali@gmail.com',
            'email_verified_at' => now(),
            'phone' => '0123654785',
            'password' => Hash::make('00114477'),
            'remember_token' => Str::random(10),
            'role_id' => 5,
            'avatar' => 'mohamed.jpg',
            'city' => 'Cairo',
            'zip' =>  234568,
            'address' => '34 Mustafa Hafeth - Helwan'
        ]);

        // Create Randowm Users
        JoinRequests::factory(10)->create();

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
