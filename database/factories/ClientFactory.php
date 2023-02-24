<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->unique()->words(3, 50),
            'cognoms' => $this->faker->unique()->words(3, 50),
            'direccio' => $this->faker->address(3, 200),
            'telefon' => $this->faker->randomNumber(9, 11, true),
        ];
    }
}
