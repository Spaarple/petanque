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
                            <p class="text-gray-700">{{ $sponsor->sponsor_description }}</p>

                            <!-- button voir plus -->
                            <a href="/sponsors/{{ $sponsor->id }}" class="mt-4 block w-full bg-indigo-500 hover:bg-indigo-600 focus:bg-indigo-600 text-white font-semibold rounded-lg px-4 py-2 text-center transition duration-300 ease-in-out">Voir plus</a>

                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
