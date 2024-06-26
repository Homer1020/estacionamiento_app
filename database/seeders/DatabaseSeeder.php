<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UbicacionesSeeder::class,
            ServicesSeeder::class,
            AutosSeeder::class,
            TerminalSeeder::class
        ]);
    }
}
