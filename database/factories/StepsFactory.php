<?php

namespace Database\Factories;

use App\Models\Ideas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Steps>
 */
class StepsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idea_id' => Ideas::factory(),
            'description' => fake()->sentence(),
            'completed' => false,
        ];
    }
}
