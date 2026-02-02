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
            'posicio' => $this->faker->randomElement(['Portera', 'Defensa', 'Migcampista', 'Davantera']),
            'edat' => $this->faker->numberBetween(16, 35),
            'equip_id' => Equip::factory(),
            'foto' => null,
        ];
    }
}