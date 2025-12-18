<?php

namespace Database\Seeders;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Seeder;

class JugadorasSeeder extends Seeder
{
    public function run(): void
    {
        $equip1 = Equip::first();
        
        if ($equip1) {
            Jugadora::create([
                'nom' => 'Alexia Putellas',
                'equip_id' => $equip1->id,
                'data_naixement' => '1994-02-04',
                'dorsal' => 11,
                'foto' => 'alexia.jpg'
            ]);

            Jugadora::create([
                'nom' => 'Aitana Bonmatí',
                'equip_id' => $equip1->id,
                'data_naixement' => '1998-01-18',
                'dorsal' => 14,
                'foto' => 'aitana.jpg'
            ]);

            Jugadora::create([
                'nom' => 'Irene Paredes',
                'equip_id' => $equip1->id,
                'data_naixement' => '1991-07-04',
                'dorsal' => 4,
                'foto' => 'irene.jpg'
            ]);
        }

        dump('JugadorasSeeder - després de crear:', Jugadora::count());
    }
}