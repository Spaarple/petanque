{{-- resources/views/admin/contact/show.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <div class="mb-4">
                <h2 class="text-lg font-bold text-gray-800">Détails du Contact</h2>
            </div>

            <div class="mb-2">
                <label class="block text-sm font-medium text-gray-700">Email:</label>
                <div class="mt-1 text-sm text-gray-600">{{ $contact->contact_sender_email }}</div>
            </div>

            <div class="mb-2">
                <label class="block text-sm font-medium text-gray-700">Message:</label>
                <div class="mt-1 text-sm text-gray-600 whitespace-pre-wrap">{{ $contact->contact_sender_message }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
