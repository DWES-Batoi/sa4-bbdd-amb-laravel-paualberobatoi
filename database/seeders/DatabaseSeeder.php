<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuario ADMIN (Este es el que usarás para entrar)
        // Usamos firstOrCreate para que no falle si lo ejecutas dos veces
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Busca por este email
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // La contraseña es 'password'
                'role' => 'admin',                // El rol es 'admin'
                'equip_id' => null,
            ]
        );

        // 2. Llamada al resto de seeders...
        $this->call([
            EstadisSeeder::class,
            EquipsSeeder::class,
            JugadorasSeeder::class,
            PartitsSeeder::class,
        ]);
    }
}