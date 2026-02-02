<?php

namespace Database\Seeders;

use App\Models\Estadi;
use Illuminate\Database\Seeder;

class EstadisSeeder extends Seeder
{
    public function run(): void
    {
        $estadis = [
            ['nom' => 'Estadi Johan Cruyff', 'capacitat' => 6000],
            ['nom' => 'Alfredo Di Stéfano', 'capacitat' => 6000],
            ['nom' => 'Centre Esportiu Wanda', 'capacitat' => 2500],
            ['nom' => 'Ciutat de València', 'capacitat' => 26354],
            ['nom' => 'Estadi Jesús Navas', 'capacitat' => 7500],
            ['nom' => 'Instalaciones de Lezama', 'capacitat' => 3200],
            ['nom' => 'Zubieta', 'capacitat' => 2500],
            ['nom' => 'Antonio Puchades', 'capacitat' => 2250],
            ['nom' => 'Campo Municipal Las Gaunas', 'capacitat' => 16000],
            ['nom' => 'Estadio Fernando Torres', 'capacitat' => 5400],
        ];

        foreach ($estadis as $estadi) {
            Estadi::create($estadi);
        }
    }
}