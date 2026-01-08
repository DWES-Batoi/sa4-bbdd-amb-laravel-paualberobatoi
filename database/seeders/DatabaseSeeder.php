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
            EquipsSeeder::class, // Els equips han d'existir abans que les jugadores
            JugadorasSeeder::class, 
            PartitsSeeder::class,
        ]);

        // Opcional: per veure que acaba
        dump('DatabaseSeeder: FIN');
    }
}