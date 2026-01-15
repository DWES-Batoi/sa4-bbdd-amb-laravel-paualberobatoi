<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Partit;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PartitsSeeder extends Seeder
{
    public function run(): void
    {
        $equips = Equip::all();
        $fechaLiga = Carbon::now()->subMonths(1); // Empezamos hace un mes

        $contador = 0;

        // Doble bucle: cada equipo juega contra todos los demás (Anada i Tornada)
        foreach ($equips as $local) {
            foreach ($equips as $visitant) {
                if ($local->id !== $visitant->id) {
                    
                    // Fecha aleatoria en los últimos 30 días o próximos 30
                    $fechaPartit = $fechaLiga->copy()->addDays(rand(1, 60));
                    
                    Partit::create([
                        'local_id'    => $local->id,
                        'visitant_id' => $visitant->id,
                        'estadi_id'   => $local->estadi_id, // Juegan en casa del local
                        'data'        => $fechaPartit,
                        'jornada'     => rand(1, 34),
                        'gols_local'  => $fechaPartit->isPast() ? rand(0, 5) : null,
                        'gols_visitant' => $fechaPartit->isPast() ? rand(0, 5) : null,
                    ]);
                    $contador++;
                }
            }
        }

        dump("PartitsSeeder - S'han creat $contador partits.");
    }
}