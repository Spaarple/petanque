<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Compte Rendus') }}
        </h2>
    </x-slot>

    {{-- deux bouton : retour edit delete --}}
    <div class="max-w-10xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="mb-4">
            <div class="flex space-x-4">
                <a href="{{ route('user.compte-rendus.index') }}"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Retour</a>
    
            </div>
        </div>






        <div class="bg-white overflow-hidden sm:rounded-lg p-5">
            <div class="mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Titre : {{ $compteRendu->title }}</h2>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Contenu : </h2>
                <p>{{ $compteRendu->content }}</p>
            </div>

            <!-- Ajoutez ici d'autres informations selon vos besoins -->

            <div class="mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Créé le : {{ $compteRendu->created_at }}</h2>
            </div>

            <div class="mb-4">
                <h2 class="text-lg font-semibold text-gray-800">Mis à jour le : {{ $compteRendu->updated_at }}
                </h2>
            </div>
        </div>
    </div>
</x-app-layout>
