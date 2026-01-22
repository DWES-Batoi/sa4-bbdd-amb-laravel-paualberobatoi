<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Jugadora;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JugadorasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_ES'); // Nombres en español
        $equips = Equip::all();

        // Jugadoras reales clave para dar realismo
        $estrellas = [
            'FC Barcelona' => [
                ['nom' => 'Alexia Putellas', 'posicio' => 'Migcampista', 'dorsal' => 11],
                ['nom' => 'Aitana Bonmatí', 'posicio' => 'Migcampista', 'dorsal' => 14],
                ['nom' => 'Salma Paralluelo', 'posicio' => 'Davantera', 'dorsal' => 7],
                ['nom' => 'Mapi León', 'posicio' => 'Defensa', 'dorsal' => 4],
                ['nom' => 'Caroline Graham Hansen', 'posicio' => 'Davantera', 'dorsal' => 10],
            ],
            'Real Madrid' => [
                ['nom' => 'Misa Rodríguez', 'posicio' => 'Portera', 'dorsal' => 1],
                ['nom' => 'Olga Carmona', 'posicio' => 'Defensa', 'dorsal' => 7],
                ['nom' => 'Athenea del Castillo', 'posicio' => 'Davantera', 'dorsal' => 22],
                ['nom' => 'Tere Abelleira', 'posicio' => 'Migcampista', 'dorsal' => 3],
            ],
            'Atlético de Madrid' => [
                ['nom' => 'Lola Gallardo', 'posicio' => 'Portera', 'dorsal' => 13],
                ['nom' => 'Ludmila da Silva', 'posicio' => 'Davantera', 'dorsal' => 8],
            ]
        ];

        foreach ($equips as $equip) {
            // 1. Insertar jugadoras reales si existen para este equipo
            if (isset($estrellas[$equip->nom])) {
                foreach ($estrellas[$equip->nom] as $jugadoraData) {
                    Jugadora::create(array_merge($jugadoraData, [
                        'equip_id' => $equip->id,
                        'edat' => $faker->numberBetween(17, 38),
                        'foto' => null
                    ]));
                }
            }

            // 2. Rellenar hasta tener 22 jugadoras con nombres realistas
            $jugadorasActuales = Jugadora::where('equip_id', $equip->id)->count();
            $faltan = 22 - $jugadorasActuales;

            for ($i = 0; $i < $faltan; $i++) {
                Jugadora::create([
                    'nom' => $faker->firstNameFemale . ' ' . $faker->lastName,
                    'dorsal' => $faker->unique()->numberBetween(1, 99),
                    'posicio' => $faker->randomElement(['Portera', 'Defensa', 'Migcampista', 'Davantera']),
                    'edat' => $faker->numberBetween(16, 35),
                    'equip_id' => $equip->id,
                    'foto' => null
                ]);
            }
            // Resetear unique para el siguiente equipo
            $faker->unique(true); 
        }
    }
}