<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Détails de l'Utilisateur</h1>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Nom : {{ $user->first_name }} {{ $user->last_name }}</h2>
                </div>

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Email : {{ $user->email }}</h2>
                </div>

                <!-- Ajoutez ici d'autres informations selon vos besoins -->

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Rôle : {{ $user->role }}</h2>
                </div>

                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Statut Licence : {{ $user->is_license_valid ? 'Valide' : 'Non Valide' }}</h2>
                </div>

                {{-- Club --}}
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Club : {{ $user->club }}</h2>
                </div>

                <!-- Boutons d'action (modifier, retour, etc.) -->
                <div class="flex space-x-4">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier</a>
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Retour</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
