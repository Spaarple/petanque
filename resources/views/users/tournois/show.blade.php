{{-- resources/views/admin/tournois/show.blade.php --}}

<x-app-layout>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="mb-2">
            <a href="{{ route('user.tournois.index') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Retour</a>
        </div>

        <div class="bg-white p-6 rounded shadow-xl">
            <h1 class="text-xl font-bold mb-4">{{ $tournoi->tournoi_name }}</h1>
            <p><strong>Description:</strong> {{ $tournoi->tournoi_description }}</p>
            <p><strong>Lieu:</strong> {{ $tournoi->tournoi_location }}</p>
            <p><strong>Date limite d'inscription:</strong> {{ $tournoi->tournoi_registration_deadline }}</p>
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
                @if ($tournoi->tournoi_max_participants <= $participants->count() || $tournoi->tournoi_registration_deadline < now())
                <p class="text-red-500">Le tournoi est complet ou la date limite d'inscription est passée</p>
                @else
                <a href="{{ route('user.tournois.inscription.create', $tournoi->id) }}"
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
                        
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($participants as $participant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $participant->user_first_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $participant->user_last_name }}</td>
                            <!-- Afficher une icône verte si le joueur a été accepté sinon un bouton pour l'accepter -->
                            
                            
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
