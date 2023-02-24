<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comanda>
 */
class ComandaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word(3, 20),
            'preu' => $this->faker->randomFloat(2, 0, 100),
            'estat' => $this->faker->randomElement(['En proces', 'Enviat', 'Rebut']),
        ];
    }
}
