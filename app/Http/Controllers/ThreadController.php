<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $threads = Thread::with(['user', 'replies'])
            ->latest()
            ->paginate(10);

        return view('threads.index', compact('threads'));
    }

    public function create()
    {
        return view('threads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10'
        ]);

        $thread = $request->user()->threads()->create($validated);

        return redirect()->route('threads.show', $thread)
            ->with('success', '¡Tema creado exitosamente!');
    }

    public function show(Thread $thread)
    {
        $thread->load(['user', 'replies.user', 'replies.votes']);
        $thread->increment('views');

        return view('threads.show', compact('thread'));
    }

    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);
        return view('threads.edit', compact('thread'));
    }

    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10'
        ]);

        $thread->update($validated);

        return redirect()->route('threads.show', $thread)
            ->with('success', '¡Tema actualizado exitosamente!');
    }

    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);

        $thread->delete();

        return redirect()->route('threads.index')
            ->with('success', '¡Tema eliminado exitosamente!');
    }
}
