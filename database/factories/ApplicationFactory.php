<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message' => fake()->text(100),
            'duration' => rand(1, 36),
            'is_accepted' => fake()->randomElement([true, false, null]),
        ];
    }
}
