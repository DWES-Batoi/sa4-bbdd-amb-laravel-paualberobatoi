<?php

namespace Database\Factories;

use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Estadi>
 */
class EstadiFactory extends Factory
{
    /**
     * Model associat a la factory
     *
     * @var string
     */
    protected $model = Estadi::class;

    /**
     * Estat per defecte
     */
    public function definition(): array
    {
        return [
            'nom'       => $this->faker->unique()->city.' Stadium',
            'capacitat' => $this->faker->numberBetween(10000, 100000),
        ];
    }
}