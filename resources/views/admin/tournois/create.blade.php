{{-- resources/views/admin/tournois/create.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <h1 class="text-xl font-bold mb-4">Créer un nouveau Concours</h1>
        <form action="{{ route('admin.tournois.store') }}" method="POST" class="bg-white p-6 rounded shadow-xl">
            @csrf
            <div class="mb-4">
                <label for="tournoi_name" class="block text-gray-700 text-sm font-bold mb-2">Nom du concours:</label>
                <input id="tournoi_name" name="tournoi_name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <div class="mb-4">
                <label for="tournoi_description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="tournoi_description" name="tournoi_description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required></textarea>
            </div>
            <div class="mb-4">
                <label for="tournoi_location" class="block text-gray-700 text-sm font-bold mb-2">Lieu:</label>
                <input id="tournoi_location" name="tournoi_location" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <!-- tournoi registration deadline -->
            <div class="mb-4"> <!-- default value today at 14:00 -->
                <label for="tournoi_registration_deadline" class="block text-gray-700 text-sm font-bold mb-2">Date limite d'inscription:</label>
                <input id="tournoi_registration_deadline" name="tournoi_registration_deadline" type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required value="{{ date('Y-m-d\TH:i', strtotime('today + 1 day')) }}">
            </div>
            <div class="mb-4"> <!-- default value today at 14:00 -->
                <label for="tournoi_start_date" class="block text-gray-700 text-sm font-bold mb-2">Date de début:</label>
                <input id="tournoi_start_date" name="tournoi_start_date" type="datetime-local" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required value="{{ date('Y-m-d\TH:i', strtotime('today + 1 day')) }}">
            </div>
            <!-- pre inscription fee (tournoi_pre_inscription_fee) -->
            <div class="mb-4">
                <label for="tournoi_pre_inscription_fee" class="block text-gray-700 text-sm font-bold mb-2">Pré-inscription:</label>
                <input id="tournoi_pre_inscription_fee" name="tournoi_pre_inscription_fee" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" min="0" required>
            </div>
            <!-- inscription fee (tournoi_inscription_fee) -->
            <div class="mb-4">
                <label for="tournoi_inscription_fee" class="block text-gray-700 text-sm font-bold mb-2">Inscription:</label>
                <input id="tournoi_inscription_fee" name="tournoi_inscription_fee" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" min="0" required>
            </div>
            <!-- tournoi team local -->
            <div class="mb-4">
                <label for="tournoi_team_local" class="block text-gray-700 text-sm font-bold mb-2">Equipe locale:</label>
                <input id="tournoi_team_local" name="tournoi_team_local" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <!-- tournoi team visitor -->
            <div class="mb-4">
                <label for="tournoi_team_visitor" class="block text-gray-700 text-sm font-bold mb-2">Equipe visiteur:</label>
                <input id="tournoi_team_visitor" name="tournoi_team_visitor" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>
            <!-- tournoi max participants -->
            <div class="mb-4">
                <label for="tournoi_max_participants" class="block text-gray-700 text-sm font-bold mb-2">Nombre maximum de participants:</label>
                <input id="tournoi_max_participants" name="tournoi_max_participants" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            </div>



            <!-- Ajouter des champs pour les autres propriétés du tournoi -->
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Créer</button>
        </form>
    </div>
</x-app-layout>
