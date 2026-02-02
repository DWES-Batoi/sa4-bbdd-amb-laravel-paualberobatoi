<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Equip;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Usuario SUPER ADMIN (Global)
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'), // 1234
                'role' => 'admin',
                'equip_id' => null,
            ]
        );

        // 2. Ejecutar Seeders de Datos
        $this->call([
            EstadisSeeder::class,
            EquipsSeeder::class,
            JugadorasSeeder::class,
            PartitsSeeder::class,
        ]);

        // 3. Crear Managers para TODOS los equipos (Requisito SA5)
        $equips = Equip::all();
        
        foreach ($equips as $equip) {
            // Crear usuario manager para este equipo (ej: manager_barca@example.com)
            $email = 'manager_' . strtolower(str_replace(' ', '', $equip->nom)) . '@example.com';
            
            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => 'Manager ' . $equip->nom,
                    'password' => bcrypt('password'),
                    'role' => 'admin', // Asumimos que 'admin' es el rol que gestiona equipos
                    'equip_id' => $equip->id,
                ]
            );
        }
    }
}