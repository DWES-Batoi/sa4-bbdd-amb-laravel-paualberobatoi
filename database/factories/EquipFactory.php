<?php

namespace Database\Factories;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Equip>
 */
class EquipFactory extends Factory
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
            'nom'       => $this->faker->unique()->company,
            'titols'    => $this->faker->numberBetween(0, 50),
            // Crearà també un Estadi associat si no en passem cap
            'estadi_id' => Estadi::factory(),
            // 'escut' => 'escuts/dummy.png',
        ];
    }
}
