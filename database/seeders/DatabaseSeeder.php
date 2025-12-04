<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Des d'ací cridem la resta de seeders
        $this->call([
            EstadisSeeder::class,
            EquipsSeeder::class,
        ]);

        // Opcional: per veure que acaba
        dump('DatabaseSeeder: FIN');
    }
}