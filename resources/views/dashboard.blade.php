<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    return view('dashboard', compact('openEvents', 'openTournois', 'registeredEvents', 'registeredTournois')); --}}

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap -mx-2">
                <div class="w-full md:w-1/2 px-2">
                    <div class="bg-white p-5 rounded-lg shadow">
                        <h2 class="font-bold text-xl mb-4">Événements auxquels je participe</h2>
                        <!-- Tableaux des événements auxquels l'utilisateur participe with link to event/tournois -->

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="text-left">Nom</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Lieu</th>
                                    <th class="text-left">Type</th>
                                    <th class="text-left">Inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($registeredEvents as $event)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 border-b">
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->event_date }}</td>
                                        <td>{{ $event->location }}</td>
                                        <td>{{ $event->type }}</td>
                                        <td><a href="{{ route('user.events.show', $event->id) }}" class="text-blue-500 hover:text-blue-700">Voir</a></td>
                                    </tr>
                                @endforeach
                                @foreach ($registeredTournois as $tournoi)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 border-b">
                                        <td>{{ $tournoi->tournoi_name }}</td>
                                        <td>{{ $tournoi->tournoi_start_date }}</td>
                                        <td>{{ $tournoi->tournoi_location }}</td>
                                        <td>Tournois</td>
                                        <td><a href="{{ route('user.tournois.show', $tournoi->id) }}" class="text-blue-500 hover:text-blue-700">Voir</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-2">
                    <div class="bg-white p-5 rounded-lg shadow">
                        <h2 class="font-bold text-xl mb-4">Nouveaux événements</h2>
                        <!-- Tableaux des nouveaux événements -->
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="text-left">Nom</th>
                                    <th class="text-left">Date</th>
                                    <th class="text-left">Lieu</th>
                                    <th class="text-left">Type</th>
                                    <th class="text-left">Inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($openEvents as $event)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 border-b">
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->event_date }}</td>
                                        <td>{{ $event->location }}</td>
                                        <td>{{ $event->type }}</td>
                                        <td><a href="{{ route('user.events.show', $event->id) }}" class="text-blue-500 hover:text-blue-700">Voir</a></td>
                                    </tr>
                                @endforeach
                                @foreach ($openTournois as $tournoi)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 border-b">
                                        <td>{{ $tournoi->tournoi_name }}</td>
                                        <td>{{ $tournoi->tournoi_start_date }}</td>
                                        <td>{{ $tournoi->tournoi_location }}</td>
                                        <td>Tournois</td>
                                        <td><a href="{{ route('user.tournois.show', $tournoi->id) }}" class="text-blue-500 hover:text-blue-700">Voir</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
