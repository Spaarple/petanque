{{-- resources/views/admin/tournois/show.blade.php --}}

<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="mb-2">
            <a href="{{ route('admin.tournois.index') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Retour</a>

            <!-- modifier le tournoi -->
            <a href="{{ route('admin.tournois.edit', $tournoi->id) }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Modifier</a>

            <!-- supprimer le tournoi -->
            <form action="{{ route('admin.tournois.destroy', $tournoi->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded shadow-xl">
            <h1 class="text-xl font-bold mb-4">{{ $tournoi->tournoi_name }}</h1>
            <p><strong>Date et heure de début:</strong> {{ $tournoi->tournoi_start_date }}</p>
            <p><strong>Pré-inscription:</strong> {{ $tournoi->tournoi_pre_inscription_fee }} €</p>
            <p><strong>Inscription:</strong> {{ $tournoi->tournoi_inscription_fee }} €</p>
            <p><strong>Equipe locale:</strong> {{ $tournoi->tournoi_team_local }}</p>
            <p><strong>Equipe visiteur:</strong> {{ $tournoi->tournoi_team_visitor }}</p>
            <p><strong>Nombre maximum de participants:</strong> {{ $tournoi->tournoi_max_participants }}</p>
            <!-- nombre de participants inscrits -->
            <p><strong>Nombre de participants inscrits:</strong> {{ $participants->count() }}</p>
        </div>
    </div>

    <!-- Affichage des joueurs inscrits au tournoi -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white p-6 rounded shadow-xl">
            <h1 class="text-xl font-bold mb-4">Joueurs inscrits au tournoi</h1>

            <div class="mb-4">
                <!-- link to create a new participation /admin/tournois/{id}/participants/create -->
                <a href="{{ route('admin.tournois.participants.create', $tournoi->id) }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Ajouter un joueur</a>
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
                    @forelse ($participants as $participant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $participant->user_first_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $participant->user_last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $participant->user_email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $participant->user_phone_number }}</td>
                            <!-- Afficher une icône verte si le joueur a été accepté sinon un bouton pour l'accepter -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                @if ($participant->is_accepted)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <form action="{{ route('admin.participants.update', $participant->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="update_type" value="status">
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Accepter</button>
                                    </form>
                                @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="{{ route('admin.participants.show', $participant->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-4">Voir</a>
                                <a href="{{ route('admin.participants.edit', $participant->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900 mr-4">Modifier</a>
                                <form action="{{ route('admin.participants.destroy', $participant->id) }}"
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
