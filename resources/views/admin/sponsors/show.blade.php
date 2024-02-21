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
                    <button type="submit"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                        Supprimer
                    </button>
                </form>
            </div>
            
            <!-- Affichage des détails du sponsor -->
            <div class="space-y-3">
                <p><strong>Logo :</strong> <img src="{{ asset('storage/' . $sponsor->sponsor_logo) }}" alt="{{ $sponsor->sponsor_name }}" class="w-32 h-32 object-cover rounded-lg"></p>
                <p><strong>Site Web :</strong> <a href="{{ $sponsor->sponsor_website }}" class="text-blue-600 hover:underline">{{ $sponsor->sponsor_website }}</a></p>
                <p><strong>Description :</strong> {{ $sponsor->sponsor_description }}</p>
                <p><strong>Nom du Contact :</strong> {{ $sponsor->sponsor_contact_name }}</p>
                <p><strong>Email du Contact :</strong> {{ $sponsor->sponsor_contact_email }}</p>
                <p><strong>Téléphone du Contact :</strong> {{ $sponsor->sponsor_contact_phone }}</p>
                <p><strong>Adresse du Contact :</strong> {{ $sponsor->sponsor_contact_address }}, {{ $sponsor->sponsor_contact_city }}, {{ $sponsor->sponsor_contact_state }}, {{ $sponsor->sponsor_contact_zip }}</p>
                <p><strong>Date de Fin d'Abonnement :</strong> {{ \Carbon\Carbon::parse($sponsor->sponsor_subscription_end_date)->format('d/m/Y') }}</p>

                <p><strong>Statut de l'Abonnement :</strong> {{ $sponsor->sponsor_subscription_status }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
