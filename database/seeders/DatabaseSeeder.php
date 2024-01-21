<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CountrySeeder::class,
            RoleSeeder::class,
            JoinRequestsSeeder::class,
            MacTypesSeeder::class,
            MacModelsSeeder::class,
            EcusSeeder::class,
        ]);
        
    }
}
