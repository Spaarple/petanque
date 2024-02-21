<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Partenaires') }}
        </h2>
    </x-slot>

    <div class="container-fluid mx-auto bg-grey-50 p-6 mb-5">
        <div class="flex flex-wrap -mx-2">
            {{-- Affichage des sponsors, si pas de sponsors afficher aucun sponsor trouvé --}}
            @if ($sponsors->isEmpty())
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="flex flex-col space-y-4 p-6">
                            <div class="text-center text-gray-500">Aucun sponsor trouvé</div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($sponsors as $sponsor)
            <div class="p-2 md:w-1/4 lg:w-1/4 sm:w-full w-full">
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow w-58>
                    <a href="/sponsors/{{ $sponsor->id }}">
                        <!-- Ajout des classes w-32 et h-32 pour définir une taille fixe de 128px par 128px -->
                        <img src="{{ asset('storage/' . $sponsor->sponsor_logo) }}" alt="{{ $sponsor->sponsor_name }}" class="w-32 h-32 object-cover rounded-t-lg">
                    </a>
                    <div class="p-5">
                        <a href="/sponsors/{{ $sponsor->id }}">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 h-10">
                                {{ $sponsor->sponsor_name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $sponsor->sponsor_description }}</p>
                        <a href="/sponsors/{{ $sponsor->id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Voir
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
</x-app-layout>
