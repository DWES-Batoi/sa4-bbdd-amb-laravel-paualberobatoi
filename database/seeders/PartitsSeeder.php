<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use App\Models\Partit;
use Illuminate\Database\Seeder;

class PartitsSeeder extends Seeder
{
    public function run(): void
    {
        $equips = Equip::all();
        $estadis = Estadi::all();

        if ($equips->count() < 2) return;

        // Generar 20 partidos pasados y 10 futuros
        for ($i = 0; $i < 30; $i++) {
            $local = $equips->random();
            $visitant = $equips->where('id', '!=', $local->id)->random();
            
            // Asignar un estadio aleatorio (o el del local si tuviéramos esa relación)
            $estadi = $estadis->random();

            Partit::create([
                'equip_local_id' => $local->id,
                'equip_visitant_id' => $visitant->id,
                'estadi_id' => $estadi->id,
                // Fechas aleatorias entre hace 2 meses y dentro de 1 mes
                'data_partit' => now()->addDays(rand(-60, 30))->format('Y-m-d H:i:s'),
                'gols_local' => rand(0, 5),
                'gols_visitant' => rand(0, 4),
            ]);
        }
    }
}