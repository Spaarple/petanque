<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Partenaires') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6 mb-5">
        <div class="flex flex-wrap justify-center">
            @if ($sponsors->isEmpty())
                <div class="w-full bg-white overflow-hidden shadow-xl sm:rounded-lg p-5 text-center">
                    Aucun sponsor trouvé
                </div>
            @else
                @foreach ($sponsors as $sponsor)
                <div class="p-4 md:w-1/3 lg:w-1/4">
                    <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 ease-in-out">
                        <a href="/sponsors/{{ $sponsor->id }}">
                            <img src="{{ asset('storage/' . $sponsor->sponsor_logo) }}" alt="{{ $sponsor->sponsor_name }}" class="w-full h-48 object-cover rounded-t-lg">
                        </a>
                        <div class="p-5">
                            <a href="/sponsors/{{ $sponsor->id }}">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 truncate">
                                    {{ $sponsor->sponsor_name }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-ellipsis overflow-hidden h-20">
                                {{ $sponsor->sponsor_description }}
                            </p>
                            <a href="/sponsors/{{ $sponsor->id }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Voir
                                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
