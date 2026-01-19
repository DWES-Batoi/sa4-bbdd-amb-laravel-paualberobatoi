<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Seeder;

class EquipsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cargamos todos los estadios de la base de datos
        $estadis = Estadi::all();

        // (Seguridad) Si por lo que sea no hay estadios, creamos uno para no fallar
        if ($estadis->isEmpty()) {
            $estadis = Estadi::factory()->count(1)->create();
        }

        // 2. Definimos los equipos y su estadio correspondiente
        $equips = [
            ['nom' => 'FC Barcelona', 'titols' => 9, 'escut' => 'barca.png', 'estadi_nom' => 'Estadi Johan Cruyff'],
            ['nom' => 'Real Madrid', 'titols' => 0, 'escut' => 'madrid.png', 'estadi_nom' => 'Alfredo Di Stéfano'],
            ['nom' => 'Atlético de Madrid', 'titols' => 4, 'escut' => 'atleti.png', 'estadi_nom' => 'Centre Esportiu Wanda'],
            ['nom' => 'Levante UD', 'titols' => 0, 'escut' => 'levante.png', 'estadi_nom' => 'Ciutat de València'],
            ['nom' => 'Sevilla FC', 'titols' => 0, 'escut' => 'sevilla.png', 'estadi_nom' => 'Estadi Jesús Navas'],
            ['nom' => 'Athletic Club', 'titols' => 5, 'escut' => 'athletic.png', 'estadi_nom' => 'Instalaciones de Lezama'],
            ['nom' => 'Real Sociedad', 'titols' => 0, 'escut' => 'realsociedad.png', 'estadi_nom' => 'Zubieta'],
            ['nom' => 'Valencia CF', 'titols' => 0, 'escut' => 'valencia.png', 'estadi_nom' => 'Antonio Puchades'],
            ['nom' => 'Levante Las Planas', 'titols' => 0, 'escut' => 'planas.png', 'estadi_nom' => 'Campo Municipal Las Gaunas'],
            ['nom' => 'Madrid CFF', 'titols' => 0, 'escut' => 'madridcff.png', 'estadi_nom' => 'Estadio Fernando Torres'],
        ];

        foreach ($equips as $equipData) {
            // Buscamos el estadio por su nombre
            $estadi = $estadis->firstWhere('nom', $equipData['estadi_nom']);
            
            // Si no encontramos el estadio exacto, asignamos uno aleatorio (fallback)
            $estadiId = $estadi ? $estadi->id : $estadis->random()->id;

            // Creamos el equipo asignándole el ID del estadio
            Equip::firstOrCreate(
                ['nom' => $equipData['nom']], // Buscamos por nombre para no duplicar
                [
                    'titols' => $equipData['titols'],
                    'escut' => $equipData['escut'],
                    'estadi_id' => $estadiId // ✅ AQUÍ ESTÁ LA SOLUCIÓN
                ]
            );
        }
    }
}