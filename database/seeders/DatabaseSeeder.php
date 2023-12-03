<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Mohamed Essam',
            'email' => 'mohamedessam.engineer@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('00114477'),
            'remember_token' => Str::random(10),
            'role_id' => 1,
        ]);
    }
}
