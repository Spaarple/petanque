<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Modifier l'Utilisateur</h1>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('admin.users.update', $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                        <input type="text" name="name" id="name" value="{{ $users->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" value="{{ $users->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- licence -->
                    <div class="mb-4">
                        <label for="licence" class="block text-gray-700 text-sm font-bold mb-2">Licence:</label>
                        <input type="text" name="licence" id="licence" value="{{ $users->licence }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    

                    <!-- role -->
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Rôle:</label>
                        <select name="role" id="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="user" {{ $users->role == 'user' ? 'selected' : '' }}>Utilisateur</option>
                            <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Administrateur</option>
                        </select>
                    </div>

                    <!-- is_approved -->
                    <div class="mb-4">
                        <label for="is_approved" class="block text-gray-700 text-sm font-bold mb-2">Statut Approbation:</label>
                        <select name="is_approved" id="is_approved" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="0" {{ $users->is_approved == 0 ? 'selected' : '' }}>Non Approuvé</option>
                            <option value="1" {{ $users->is_approved == 1 ? 'selected' : '' }}>Approuvé</option>
                        </select>
                    </div>

                    



                    

                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
