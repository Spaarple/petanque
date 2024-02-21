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
                    <img src="{{ asset('storage/' . $sponsor->sponsor_logo) }}" alt="{{ $sponsor->sponsor_name }}"
                        class="w-full mb-4 object-contain">
                    <p><strong>Site Web:</strong> <a target="_blank" href="{{ $sponsor->sponsor_website }}"
                            class="text-blue-600 hover:text-blue-800">{{ $sponsor->sponsor_website }}</a></p>
                    <p><strong>Description:</strong> {{ $sponsor->sponsor_description ?? 'No description provided.' }}
                    </p>
                    <p><strong>Email:</strong> {{ $sponsor->sponsor_contact_email }}</p>
                    <p><strong>Téléphone:</strong> {{ $sponsor->sponsor_contact_phone }}</p>
                    <p><strong>Adresse:</strong> {{ $sponsor->sponsor_contact_address }}</p>

                    {{-- Affichage des photos de l'album du sponsor --}}
                    @if($sponsor->photos->isNotEmpty())
                        <div class="mt-6 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach ($sponsor->photos as $photo)
                                <div>
                                    <img src="{{ Storage::url($photo->path) }}" alt="Photo" class="rounded-lg shadow-md">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-6">Aucune photo disponible pour cet album.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
