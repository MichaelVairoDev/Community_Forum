<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Thread $thread)
    {
        $validated = $request->validate([
            'content' => 'required|min:5'
        ]);

        $reply = $thread->replies()->create([
            'user_id' => $request->user()->id,
            'content' => $validated['content']
        ]);

        return back()->with('success', '¡Respuesta publicada exitosamente!');
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $validated = $request->validate([
            'content' => 'required|min:5'
        ]);

        $reply->update($validated);

        return back()->with('success', '¡Respuesta actualizada exitosamente!');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        return back()->with('success', '¡Respuesta eliminada exitosamente!');
    }

    public function markAsSolution(Reply $reply)
    {
        $thread = $reply->thread;
        $this->authorize('update', $thread);

        // Remove solution status from any other reply in this thread
        $thread->replies()->update(['is_solution' => false]);

        $reply->update(['is_solution' => true]);
        $thread->update(['is_resolved' => true]);

        return back()->with('success', '¡Respuesta marcada como solución!');
    }

    public function vote(Request $request, Reply $reply)
    {
        $isUpvote = $request->input('is_upvote');
        $user = $request->user();

        $existingVote = $reply->votes()->where('user_id', $user->id)->first();

        if ($existingVote) {
            if ($existingVote->is_upvote === $isUpvote) {
                $existingVote->delete();
                $message = '¡Voto removido!';
            } else {
                $existingVote->update(['is_upvote' => $isUpvote]);
                $message = $isUpvote ? '¡Voto positivo actualizado!' : '¡Voto negativo actualizado!';
            }
        } else {
            $reply->votes()->create([
                'user_id' => $user->id,
                'is_upvote' => $isUpvote
            ]);
            $message = $isUpvote ? '¡Voto positivo registrado!' : '¡Voto negativo registrado!';
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'score' => $reply->score()
            ]);
        }

        return back()->with('success', $message);
    }
}
