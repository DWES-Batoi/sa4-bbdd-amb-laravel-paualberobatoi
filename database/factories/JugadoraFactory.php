<?php

namespace Database\Factories;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Equip>
 */
class JugadoraFactory extends Factory
{
    /**
     * Model associat a la factory
     *
     * @var string
     */
    protected $model = Equip::class;

    /**
     * Estat per defecte
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->name(),
            'equip_id' => Equip::all()->random()->id,
            'data_naixement' => fake()->date('Y-m-d', '-18 years'), 
            'dorsal' => fake()->unique()->numberBetween(1, 99),
            'foto' => null,
        ];
    }
}
