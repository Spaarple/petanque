<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Compte Rendus') }}
        </h2>
    </x-slot>

    {{-- create --}}
    <div class="max-w-10xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="mb-4">
                <a href="{{ route('admin.compte-rendus.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter un compte
                    rendu</a>
            </div>

            <div class="bg-white overflow-hidden sm:rounded-lg p-5">
                @foreach ($compteRendus as $compteRendu)
                    <div class="mt-4">
                        {{-- title color blue --}}
                        <a href="{{ route('admin.compte-rendus.show', $compteRendu->id) }}"
                            class="text-lg font-semibold text-blue-500 hover:text-blue-700">{{ $compteRendu->title }}</a>
                        {{-- content --}}
                        <p>{{ \Illuminate\Support\Str::limit($compteRendu->content, 100) }}</p>
                        {{-- separator --}}
                        <div class="border-b border-gray-200 my-4"></div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
