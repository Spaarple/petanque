<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Joueurs') }}
        </h2>
    </x-slot>
    <div class="container mx-auto px-4 py-8">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
            @foreach ($users as $user)
                <div
                    class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md">
                    {{-- Photo de profil, si pas de photo de profile afficher pas d'image --}}
                    @if ($user->profile_photo_path)
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <img class="rounded-t-lg h-full" src="{{ asset('storage/' . $user->profile_photo_path) }}"
                            alt="Photo de {{ $user->first_name }} {{ $user->last_name }}">
                        </div>
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Pas d'image</span>
                        </div>
                    @endif
                    <div class="p-5">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                            {{ $user->first_name }} {{ $user->last_name }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
