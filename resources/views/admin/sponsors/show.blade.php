<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $sponsor->sponsor_name }}</h2>
            <div class="mb-4">
                <a href="{{ route('admin.sponsors.edit', $sponsor->id) }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Modifier
                </a>
                <form action="{{ route('admin.sponsors.destroy', $sponsor->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Supprimer
                    </button>
                </form>
            </div>

            <!-- Affichage des détails du sponsor -->
            <div class="space-y-3">
                <p><strong>Logo :</strong> <img src="{{ asset('storage/' . $sponsor->sponsor_logo) }}"
                        alt="{{ $sponsor->sponsor_name }}" class="w-32 h-32 object-cover rounded-lg"></p>
                <p><strong>Site Web :</strong> <a href="{{ $sponsor->sponsor_website }}"
                        class="text-blue-600 hover:underline">{{ $sponsor->sponsor_website }}</a></p>
                <p><strong>Description :</strong> {{ $sponsor->sponsor_description }}</p>
                <p><strong>Nom du Contact :</strong> {{ $sponsor->sponsor_contact_name }}</p>
                <p><strong>Email du Contact :</strong> {{ $sponsor->sponsor_contact_email }}</p>
                <p><strong>Téléphone du Contact :</strong> {{ $sponsor->sponsor_contact_phone }}</p>
                <p><strong>Adresse du Contact :</strong> {{ $sponsor->sponsor_contact_address }},
                    {{ $sponsor->sponsor_contact_city }}, {{ $sponsor->sponsor_contact_state }},
                    {{ $sponsor->sponsor_contact_zip }}</p>
                <p><strong>Date de Fin d'Abonnement :</strong>
                    {{ \Carbon\Carbon::parse($sponsor->sponsor_subscription_end_date)->format('d/m/Y') }}</p>


                {{-- display the images with delete button --}}
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-900">Aperçu des Photos du Sponsor</h2>
                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($sponsor->photos as $photo)
                            <div class="relative group">
                                <img src="{{ Storage::url($photo->path) }}" alt="Photo du sponsor"
                                    class="w-full h-48 object-cover rounded-md">
                                <!-- Facultatif: Afficher une légende ou une description, si disponible -->
                                @if ($photo->caption)
                                    <div
                                        class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-sm p-2 rounded-b-md">
                                        {{ $photo->caption }}
                                    </div>
                                @endif
                                <!-- Bouton de suppression -->
                                <form
                                    action="{{ route('admin.sponsors.photos.delete', ['sponsor' => $sponsor->id, 'photo' => $photo->id]) }}"
                                    method="POST" class="absolute top-0 right-0 mt-2 mr-2"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
