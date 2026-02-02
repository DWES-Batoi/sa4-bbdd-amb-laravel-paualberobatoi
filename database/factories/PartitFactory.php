<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equip;
use App\Models\Estadi;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partit>
 */
class PartitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Obtenemos IDs aleatorios para equipos y estadios
        // Ojo: Esto asume que ya existen registros. Si se ejecuta en un entorno vacío podría fallar,
        // pero es estándar en factories usar factories relacionados o asumir existencia tras seeders previos.
        // Para mayor robustez, podríamos usar Equip::factory(), pero si ya tenemos seeders, esto es suficiente.
        
        return [
            'equip_local_id' => Equip::inRandomOrder()->first()->id ?? Equip::factory(),
            'equip_visitant_id' => Equip::inRandomOrder()->first()->id ?? Equip::factory(),
            'estadi_id' => Estadi::inRandomOrder()->first()->id ?? Estadi::factory(),
            'data_partit' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'gols_local' => $this->faker->numberBetween(0, 5),
            'gols_visitant' => $this->faker->numberBetween(0, 5),
        ];
    }
}
