<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => rtrim(fake()->sentence(rand(5, 10)), '.'),
            'content' => fake()->paragraphs(rand(3, 6), true),
            'views' => fake()->numberBetween(0, 1000),
            'is_resolved' => fake()->boolean(20),
        ];
    }
}
