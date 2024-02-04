<x-app-layout>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Liste des Joueurs</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @foreach($users as $user)
            <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <img class="rounded-t-lg" src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Photo de {{ $user->name }}" />
                <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $user->name }}</h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
</x-app-layout>
