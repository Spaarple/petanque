{{-- resources/views/events/index.blade.php --}}
@php
use Carbon\Carbon;
@endphp
<x-app-layout>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        {{-- Si l'utilisateur est connecté et est is_approuved, afficher le bouton pour créer un événement --}}
        @if(auth()->check())
        <div class="flex justify-between items-center px-4 py-3 bg-gray-50 text-right sm:px-6">
            <a href="{{ route('user.events.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Créer un événement</a>
        </div>
        @endif
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            

            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($events as $event)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $event->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $event->type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ Carbon::parse($event->event_date)->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('user.events.show', $event->id) }}" class="text-indigo-600 hover:text-indigo-900">Voir</a>
                                {{-- if user is admin, show the edit and delete buttons --}}
                                @if(auth()->check() && auth()->user()->role == 'admin' or auth()->user()->id == $event->user_id)
                                    
                                    <a href="{{ route('user.events.edit', $event->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Éditer</a>
                                    <form action="{{ route('user.events.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Supprimer</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
