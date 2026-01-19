<?php

namespace Database\Factories;

use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->city . ' FC',
            'titols' => $this->faker->numberBetween(0, 30),
            'escut' => null,
            // ✅ Crea un estadio automáticamente si no se le pasa uno
            'estadi_id' => Estadi::factory(), 
        ];
    }
}