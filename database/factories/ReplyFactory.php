<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
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
            'thread_id' => \App\Models\Thread::factory(),
            'content' => fake()->paragraphs(rand(1, 3), true),
            'is_solution' => false, // We'll handle this in the seeder
        ];
    }
}
