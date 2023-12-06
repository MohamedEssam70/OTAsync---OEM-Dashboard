<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use \App\Models\User;


class DatabaseSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop all rows
        User::truncate();
        
        // Create Main Users
        User::create([
            'firstname' => 'Mohamed',
            'lastname' => 'Essam',
            'email' => 'mohamedessam.engineer@gmail.com',
            'email_verified_at' => now(),
            'phone' => '150705858',
            'password' => Hash::make('00114477'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
            'avatar' => 'mohamed.jpg',
            'city' => 'Cairo',
            'zip' =>  234568,
            'address' => '34 Mustafa Hafeth - Helwan'
        ]);

        // Create Randowm Users
        User::factory(10)->create();

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
