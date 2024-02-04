<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Partenaires') }}
        </h2>
    </x-slot>

    <div class="container-fluid mx-auto bg-grey-50 p-6 mb-5">
        <div class="flex flex-wrap -mx-2">
            @foreach ($sponsors as $sponsor)
                <div class="p-2 w-1/2 md:w-1/4 lg:w-1/6">
                    <div class="flex flex-col justify-between bg-white shadow-lg rounded-lg p-4 h-56">
                        <div class="flex-1 flex items-center justify-center">
                            <img src="{{ $sponsor->sponsor_logo }}" alt="{{ $sponsor->sponsor_name }}"
                                class="max-h-28 w-auto mb-3 object-contain">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">{{ $sponsor->sponsor_name }}</h3>
                            <a href="{{ route('user.sponsors.show', $sponsor->id) }}"
                                class="text-blue-600 hover:text-blue-800">Visiter le site</a>
                            <a href="{{ route('user.sponsors.show', $sponsor->id) }}"
                                class="text-green-600 hover:text-green-800 mt-2">Voir détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
