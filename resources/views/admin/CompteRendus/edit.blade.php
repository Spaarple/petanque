<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Compte Rendus') }}
        </h2>
    </x-slot>

    {{-- edit --}}
    <div class="max-w-10xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="mb-4">
            {{-- Retour, delete --}}
            <div class="flex space-x-4">
                <a href="{{ route('admin.compte-rendus.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Retour</a>
                <form action="{{ route('admin.compte-rendus.destroy', $compteRendu->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                </form>
            </div>
        </div>

        <div class="bg-white overflow-hidden sm:rounded-lg p-5">
            <form action="{{ route('admin.compte-rendus.update', $compteRendu->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titre:</label>
                    <input type="text" name="title" id="title" value="{{ $compteRendu->title }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Contenu:</label>
                    <textarea name="content" id="content"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>{{ $compteRendu->content }}</textarea>
                </div>
                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
