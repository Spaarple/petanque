{{-- resources/views/events/show.blade.php --}}
@php
use Carbon\Carbon;
@endphp
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
            <div class="mb-4">
                <h2 class="text-xl font-bold text-gray-800">{{ $event->name }}</h2>
                <p class="text-gray-600">{{ $event->description }}</p>
            </div>

            <div class="mb-4">
                <strong>Type d'événement:</strong> {{ $event->type }}
            </div>

            <div class="mb-4">
                <strong>Date de l'événement:</strong> {{ Carbon::parse($event->event_date)->format('d/m/Y H:i') }}
            </div>

            <div class="mb-4">
                <strong>Nombre de participants:</strong> {{ $eventregistrations->count() }} / {{ $event->max_participants }}
            </div>
        </div>
    </div>

    <!-- Affichage des joueurs inscrits au tournoi -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white p-6 rounded shadow-xl">
            <h1 class="text-xl font-bold mb-4">Joueurs inscrits à l'évènement</h1>

            <div class="mb-4">
                <!-- link to create a new participation /admin/tournois/{id}/participants/create -->
                <!-- if the number of participants is less than the maximum number of participants -->
                @if ($eventregistrations->count() < $event->max_participants)
                    <a href="{{ route('admin.eventregistrations.create', $event->id) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter un joueur</a>
                @endif
            </div>



            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prénom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Téléphone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Accepté</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($eventregistrations as $eventregistration)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $eventregistration->user_first_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $eventregistration->user_last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $eventregistration->user_email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $eventregistration->user_phone_number }}</td>
                            <!-- Afficher une icône verte si le joueur a été accepté sinon un bouton pour l'accepter -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                @if ($eventregistration->is_accepted)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <form action="{{ route('admin.eventregistrations.update', $eventregistration->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="update_type" value="status">
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Accepter</button>
                                    </form>
                                @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="{{ route('admin.eventregistrations.show', $eventregistration->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-4">Voir</a>
                                <a href="{{ route('admin.eventregistrations.edit', $eventregistration->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-4">Modifier</a>
                                <form action="{{ route('admin.eventregistrations.destroy', $eventregistration->id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Aucun joueur inscrit</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
