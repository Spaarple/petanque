{{-- resources/views/admin/contacts/archived.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Message</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($archivedContacts as $contact)
                        <tr>
                            <td>{{ $contact->contact_sender_email }}</td>
                            <td>{{ $contact->contact_sender_message }}</td>
                            {{-- <td>
                                <!-- Ajoutez ici les actions que vous souhaitez effectuer avec les contacts archivés -->
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
