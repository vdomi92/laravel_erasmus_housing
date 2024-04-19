<?php

namespace Database\Factories;

use App\Models\Housing;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Housing>
 */
class HousingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => fake()->country(),
            'zip' => fake()->postcode(),
            'city' => fake()->city(),
            'street' => fake()->streetName(),
            'house_nr' => rand(1, 1000),
            'description' => fake()->text(100),
        ];
    }
}
