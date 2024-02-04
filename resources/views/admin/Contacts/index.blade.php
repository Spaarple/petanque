{{-- resources/views/admin/contact/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('admin.contacts.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Envoyer un message
            </a>
            <label class="flex items-center space-x-3">
                <input type="checkbox" id="showArchived" class="form-checkbox h-5 w-5 text-blue-600">
                <span class="text-gray-700 dark:text-white font-medium">Afficher les éléments archivés</span>
            </label>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Objet</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Message</th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($contacts as $contact)
                        <tr class="{{ $contact->is_archived ? 'bg-gray-200' : '' }}">
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $contact->contact_sender_email }}</td>

                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $contact->contact_sender_object }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $contact->contact_sender_message }}</td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 space-x-3">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Voir</a>
                                <a href="{{ route('admin.contacts.edit', $contact->id) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Modifier</a>
                                @if ($contact->is_archived)
                                    {{-- Formulaire pour désarchiver un contact --}}
                                    <form action="{{ route('admin.contacts.unarchive', $contact->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="text-green-600 hover:text-green-900">Désarchiver</button>
                                    </form>
                                @else
                                    {{-- Formulaire pour archiver un contact --}}
                                    <form action="{{ route('admin.contacts.archive', $contact->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="text-yellow-600 hover:text-yellow-900">Archiver</button>
                                    </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.contacts.archived') }}" class="text-blue-600 hover:text-blue-800">Voir les
                archives</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fonction pour mettre à jour la visibilité des lignes
            function updateRowsVisibility() {
                let showArchived = document.getElementById('showArchived').checked;
                let rows = document.querySelectorAll('table tbody tr');
                rows.forEach(row => {
                    if (row.classList.contains('bg-gray-200') && !showArchived) {
                        row.style.display = 'none';
                    } else {
                        row.style.display = '';
                    }
                });
            }

            // Attacher l'écouteur d'événements pour le changement d'état de la case à cocher
            document.getElementById('showArchived').addEventListener('change', updateRowsVisibility);

            // Exécuter la fonction pour initialiser l'état correct des lignes
            updateRowsVisibility();
        });
    </script>

</x-app-layout>
