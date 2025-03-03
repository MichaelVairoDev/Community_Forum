<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">Foro de la Comunidad</h1>
                @auth
                    <a href="{{ route('threads.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                        Nuevo Tema
                    </a>
                @endauth
            </div>

            <div class="space-y-4">
                @foreach($threads as $thread)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2">
                                    @if($thread->is_resolved)
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            Resuelto
                                        </span>
                                    @endif
                                    <h2 class="text-xl font-semibold">
                                        <a href="{{ route('threads.show', $thread) }}" class="hover:text-blue-600">
                                            {{ $thread->title }}
                                        </a>
                                    </h2>
                                </div>
                                <div class="mt-2 text-gray-600">
                                    {{ Str::limit(strip_tags($thread->content), 200) }}
                                </div>
                                <div class="mt-4 flex items-center text-sm text-gray-500">
                                    <span>Por {{ $thread->user->name }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $thread->created_at->diffForHumans() }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $thread->replies->count() }} respuestas</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $thread->views }} vistas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4">
                    {{ $threads->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
