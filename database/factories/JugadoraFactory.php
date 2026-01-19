<?php

namespace Database\Factories;

use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadoraFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name('female'),
            'dorsal' => $this->faker->numberBetween(1, 99),
            'posicio' => $this->faker->randomElement(['Portera', 'Defensa', 'Migcampista', 'Davantera']), // ✅ AÑADIDO
            'data_naixement' => $this->faker->date('Y-m-d', '2005-01-01'), // ✅ AÑADIDO
            'equip_id' => Equip::factory(),
            'foto' => null,
        ];
    }
}