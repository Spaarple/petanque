<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>
    <div class="max-w-10xl mx-auto sm:px-6 lg:px-8 py-8">

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('admin.users.update', $users->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">Prénom:</label>
                        <input type="text" name="first_name" id="first_name" value="{{ $users->first_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>

                    </div>

                    <div class="mb-4">
                        <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Nom:</label>
                        <input type="text" name="last_name" id="last_name" value="{{ $users->last_name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" value="{{ $users->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>

                    <!-- phone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone:</label>
                        <input type="text" name="phone" id="phone" value="{{ $users->phone }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- birthday -->
                    <div class="mb-4">
                        <label for="birthday" class="block text-gray-700 text-sm font-bold mb-2">Date de naissance:</label>
                        <input type="date" name="birthday" id="birthday" value="{{ $users->birthday }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- address -->
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Adresse:</label>
                        <input type="text" name="address" id="address" value="{{ $users->address }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
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

                    <!-- club -->
                    <div class="mb-4">
                        <label for="club" class="block text-gray-700 text-sm font-bold mb-2">Club:</label>
                        <input type="text" name="club" id="club" value="{{ $users->club }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    



                    

                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
