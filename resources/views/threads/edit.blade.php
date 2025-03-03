<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-semibold text-gray-900 mb-6">Editar Tema</h1>

                    <form action="{{ route('threads.update', $thread) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $thread->title) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
                            <textarea name="content" id="content" rows="6"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                required>{{ old('content', $thread->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('threads.show', $thread) }}" class="text-gray-600 hover:text-gray-900 mr-4">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                Actualizar Tema
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
