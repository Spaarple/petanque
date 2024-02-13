{{-- resources/views/sponsors/show.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $sponsor->sponsor_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img src="{{ $sponsor->sponsor_logo }}" alt="{{ $sponsor->sponsor_name }}" class="w-full mb-4 object-contain">
                    <p><strong>Website:</strong> <a href="{{ $sponsor->sponsor_website }}" class="text-blue-600 hover:text-blue-800">{{ $sponsor->sponsor_website }}</a></p>
                    <p><strong>Description:</strong> {{ $sponsor->sponsor_description ?? 'No description provided.' }}</p>
                    <!-- Autres détails du sponsor -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
