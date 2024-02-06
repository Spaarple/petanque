{{-- resources/views/user/tournois/index.blade.php --}}
<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="text-xl font-semibold border-b px-6 py-4">
                LES PROCHAINS TOURNOIS
            </div>
            <div class="flex flex-col space-y-4 p-6">
                @foreach ($tournois as $tournoi)
                <div class="flex items-start">
                    <div class="w-24 h-24 bg-blue-500 rounded-full mr-3 flex-shrink-0 mt-1 flex items-center justify-center">
                        <span class="text-white text-xs">{{ \Carbon\Carbon::parse($tournoi->tournoi_start_date)->format('d M Y') }}</span>
                    </div>
                    <div class="flex-1 border-l-2 border-gray-200 pl-4">
                        <h3 class="text-lg font-semibold">{{ $tournoi->tournoi_name }}</h3>
                            
                            <div class="text-sm mt-2">
                                <strong>Heure de début :</strong> {{ \Carbon\Carbon::parse($tournoi->tournoi_start_date)->format('h:m') }}<br>
                                <strong>Description :</strong> {{ $tournoi->tournoi_description }}<br>
                                <strong>Lieu :</strong> {{ $tournoi->tournoi_location }}<br>
                                <strong>Date limite d'inscription :</strong> {{ \Carbon\Carbon::parse($tournoi->tournoi_registration_deadline)->format('d M Y') }}<br>
                                <strong>Frais de pré-inscription :</strong>
                                {{ $tournoi->tournoi_pre_inscription_fee }}<br>
                                <strong>Frais d'inscription :</strong> {{ $tournoi->tournoi_inscription_fee }}<br>
                                <strong>Participants max :</strong> {{ $tournoi->tournoi_max_participants }}<br>
                                <strong>Équipe locale :</strong> {{ $tournoi->tournoi_team_local }}<br>
                                <strong>Équipe visiteur :</strong> {{ $tournoi->tournoi_team_visitor }}
                            </div>
                            <!-- voir les participants inscrits -->
                            <div class="mt-2">
                                <a href="{{ route('user.tournois.show', $tournoi->id) }}"
                                    class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Voir les détails du tournoi
                                </a>
                                <a href="{{ route('user.tournois.inscription.create', $tournoi->id) }}"
                                    class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    S'inscrire
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
