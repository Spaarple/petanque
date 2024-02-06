{{-- resources/views/users/contacts/messages.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('user.contacts.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Envoyer un message
            </a>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <!-- if user is not connected do not display table-->
            @if (Auth::check())
            <table class="min-w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Email
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Object
                        </th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Message
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse ($contacts as $contact)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $contact->contact_sender_email }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $contact->contact_sender_object }}
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                {{ $contact->contact_sender_message }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200" colspan="3">
                                Aucun message disponible.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @endif

        </div>
    </div>
</x-app-layout>
