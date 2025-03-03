<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\Vote;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuarios de ejemplo
        $users = User::factory(10)->create();

        // Crear temas
        $threads = Thread::factory(15)->create([
            'user_id' => fn() => $users->random()->id
        ]);

        // Para cada tema, crear entre 2 y 8 respuestas
        $threads->each(function ($thread) use ($users) {
            $replies = Reply::factory(rand(2, 8))->create([
                'thread_id' => $thread->id,
                'user_id' => fn() => $users->random()->id
            ]);

            // Si el tema está marcado como resuelto, marcar una respuesta aleatoria como solución
            if ($thread->is_resolved) {
                $solution = $replies->random();
                $solution->update(['is_solution' => true]);
            }

            // Crear votos aleatorios para cada respuesta
            $replies->each(function ($reply) use ($users) {
                $votingUsers = $users->random(rand(0, 7));
                foreach ($votingUsers as $user) {
                    Vote::create([
                        'user_id' => $user->id,
                        'reply_id' => $reply->id,
                        'is_upvote' => rand(0, 100) < 70 // 70% probabilidad de voto positivo
                    ]);
                }
            });
        });
    }
}
