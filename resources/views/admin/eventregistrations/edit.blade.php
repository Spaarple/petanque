{{-- resources/views/admin/participants/edit.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white p-6 rounded shadow-xl">
            <h2 class="text-xl font-bold mb-4">Modifier les informations du participant</h2>
            <form action="{{ route('admin.participants.update', $participants->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="user_first_name" class="block text-gray-700 text-sm font-bold mb-2">Prénom:</label>
                    <input id="user_first_name" name="user_first_name" type="text" value="{{ $participants->user_first_name }}" class="p-2 border rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label for="user_last_name" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                    <input id="user_last_name" name="user_last_name" type="text" value="{{ $participants->user_last_name }}" class="p-2 border rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label for="user_email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input id="user_email" name="user_email" type="email" value="{{ $participants->user_email }}" class="p-2 border rounded w-full" required>
                </div>

                <div class="mb-4">
                    <label for="user_phone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone:</label>
                    <input id="user_phone" name="user_phone" type="text" value="{{ $participants->user_phone_number }}" class="p-2 border rounded w-full" required>
                </div>

                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Mettre à jour
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
