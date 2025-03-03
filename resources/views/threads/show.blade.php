<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Thread -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h1 class="text-2xl font-semibold text-gray-900">{{ $thread->title }}</h1>
                            <div class="mt-2 text-gray-600 space-y-4">
                                {!! nl2br(e($thread->content)) !!}
                            </div>
                            <div class="mt-4 flex items-center text-sm text-gray-500">
                                <span>Por {{ $thread->user->name }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $thread->created_at->diffForHumans() }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $thread->views }} vistas</span>
                            </div>
                        </div>
                        @can('update', $thread)
                            <div class="flex space-x-2">
                                <a href="{{ route('threads.edit', $thread) }}"
                                   class="text-blue-600 hover:text-blue-800">Editar</a>
                                <form action="{{ route('threads.destroy', $thread) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro que deseas eliminar este tema?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                                </form>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Replies -->
            <div class="space-y-6">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-900">Respuestas</h2>
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                        {{ $thread->replies->count() }} respuestas
                    </span>
                </div>

                @foreach($thread->replies as $reply)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" id="reply-{{ $reply->id }}">
                        <div class="p-6">
                            <div class="flex">
                                <!-- Voting -->
                                <div class="flex flex-col items-center mr-4">
                                    @auth
                                        <form action="{{ route('replies.vote', $reply) }}" method="POST" class="vote-form">
                                            @csrf
                                            <input type="hidden" name="is_upvote" value="1">
                                            <button type="submit" class="text-gray-500 hover:text-blue-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                                                </svg>
                                            </button>
                                        </form>
                                        <span class="text-gray-700 my-1">{{ $reply->score() }}</span>
                                        <form action="{{ route('replies.vote', $reply) }}" method="POST" class="vote-form">
                                            @csrf
                                            <input type="hidden" name="is_upvote" value="0">
                                            <button type="submit" class="text-gray-500 hover:text-red-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                </svg>
                                            </button>
                                        </form>
                                    @endauth
                                </div>

                                <!-- Reply Content -->
                                <div class="flex-1">
                                    <div class="flex items-start justify-between">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-medium">{{ $reply->user->name }}</span>
                                            <span class="text-gray-500 text-sm">{{ $reply->created_at->diffForHumans() }}</span>
                                            @if($reply->is_solution)
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                                    Solución
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            @can('update', $thread)
                                                @unless($reply->is_solution)
                                                    <form action="{{ route('replies.solution', $reply) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="text-green-600 hover:text-green-800">
                                                            Marcar como solución
                                                        </button>
                                                    </form>
                                                @endunless
                                            @endcan
                                            @can('update', $reply)
                                                <button onclick="editReply({{ $reply->id }})" class="text-blue-600 hover:text-blue-800">
                                                    Editar
                                                </button>
                                            @endcan
                                            @can('delete', $reply)
                                                <form action="{{ route('replies.destroy', $reply) }}" method="POST"
                                                      onsubmit="return confirm('¿Estás seguro que deseas eliminar esta respuesta?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800">Eliminar</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="mt-2 text-gray-600 reply-content-{{ $reply->id }}">
                                        {!! nl2br(e($reply->content)) !!}
                                    </div>
                                    <form action="{{ route('replies.update', $reply) }}" method="POST"
                                          class="hidden mt-2 reply-form-{{ $reply->id }}">
                                        @csrf
                                        @method('PATCH')
                                        <textarea name="content" rows="3"
                                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                required>{{ $reply->content }}</textarea>
                                        <div class="mt-2 flex justify-end space-x-2">
                                            <button type="button" onclick="cancelEdit({{ $reply->id }})"
                                                    class="text-gray-600 hover:text-gray-900">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                                Actualizar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Reply Form -->
                @auth
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Agregar una respuesta</h3>
                            <form action="{{ route('replies.store', $thread) }}" method="POST">
                                @csrf
                                <textarea name="content" rows="4"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        required>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <div class="mt-4 flex justify-end">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                        Publicar Respuesta
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center">
                            <p class="text-gray-600">
                                Para responder, por favor
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">inicia sesión</a>
                                o
                                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">regístrate</a>.
                            </p>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function editReply(replyId) {
            document.querySelector(`.reply-content-${replyId}`).classList.add('hidden');
            document.querySelector(`.reply-form-${replyId}`).classList.remove('hidden');
        }

        function cancelEdit(replyId) {
            document.querySelector(`.reply-content-${replyId}`).classList.remove('hidden');
            document.querySelector(`.reply-form-${replyId}`).classList.add('hidden');
        }
    </script>
    @endpush
</x-app-layout>
