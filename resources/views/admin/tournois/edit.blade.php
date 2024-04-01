{{-- resources/views/admin/tournois/edit.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <form action="{{ route('admin.tournois.update', $tournoi->id) }}" method="POST" class="bg-white p-6 rounded shadow-xl">
            @csrf
            @method('PUT')
            <h1 class="text-xl font-bold mb-4">Modifier le concours</h1>
            <div class="mb-4">
                <label for="tournoi_name" class="block text-gray-700 text-sm font-bold mb-2">Nom du concours:</label>
                <input id="tournoi_name" name="tournoi_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_name }}" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="tournoi_description" name="tournoi_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>{{ $tournoi->tournoi_description }}</textarea>
            </div>
            <div class="mb-4">
                <label for="tournoi_location" class="block text-gray-700 text-sm font-bold mb-2">Lieu:</label>
                <input id="tournoi_location" name="tournoi_location" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_location }}" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_registration_deadline" class="block text-gray-700 text-sm font-bold mb-2">Date limite d'inscription:</label>
                <input id="tournoi_registration_deadline" name="tournoi_registration_deadline" type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_registration_deadline }}" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_start_date" class="block text-gray-700 text-sm font-bold mb-2">Date de début:</label>
                <input id="tournoi_start_date" name="tournoi_start_date" type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_start_date }}" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_pre_inscription_fee" class="block text-gray-700 text-sm font-bold mb-2">Pré-inscription:</label>
                <input id="tournoi_pre_inscription_fee" name="tournoi_pre_inscription_fee" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_pre_inscription_fee }}" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_inscription_fee" class="block text-gray-700 text-sm font-bold mb-2">Inscription:</label>
                <input id="tournoi_inscription_fee" name="tournoi_inscription_fee" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_inscription_fee }}" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_team_local" class="block text-gray-700 text-sm font-bold mb-2">Equipe locale:</label>
                <input id="tournoi_team_local" name="tournoi_team_local" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_team_local }}" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_team_visitor" class="block text-gray-700 text-sm font-bold mb-2">Equipe visiteur:</label>
                <input id="tournoi_team_visitor" name="tournoi_team_visitor" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_team_visitor }}" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_max_participants" class="block text-gray-700 text-sm font-bold mb-2">Nombre maximum de participants:</label>
                <input id="tournoi_max_participants" name="tournoi_max_participants" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" value="{{ $tournoi->tournoi_max_participants }}" required>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>
