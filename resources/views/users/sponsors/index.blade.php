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
                <div class="p-2 w-1/2 md:w-1/4 lg:w-1/6">
                    <div class="flex flex-col justify-between bg-white shadow-lg rounded-lg p-4 h-56">
                        <div class="flex-1 flex items-center justify-center">
                            <img src="{{ asset( 'storage/' . $sponsor->sponsor_logo) }}" alt="{{ $sponsor->sponsor_name }}"
                                class="max-h-28 w-auto mb-3 object-contain">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">{{ $sponsor->sponsor_name }}</h3>
                            <a href="{{ route('user.sponsors.show', $sponsor->id) }}"
                                class="text-green-600 hover:text-green-800 mt-2">Voir détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
