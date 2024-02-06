{{-- resources/views/admin/contact/create.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
            <form action="{{ route('user.contacts.store') }}" method="POST" class="space-y-6">
                @csrf
                {{-- Si l'utilisateur est connecté --}}
                @if (Auth::check())
                    <div>
                        <label for="contact_sender_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="contact_sender_email" id="contact_sender_email"
                            value="{{ Auth::user()->email }}" readonly
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                @else
                    <div>
                        <label for="contact_sender_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="contact_sender_email" id="contact_sender_email" required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                @endif
                
                {{-- contact_sender_object --}}
                <div>
                    <label for="contact_sender_object" class="block text-sm font-medium text-gray-700">Objet</label>
                    <input type="text" name="contact_sender_object" id="contact_sender_object" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                  
                <div>
                    <label for="contact_sender_message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="contact_sender_message" id="contact_sender_message" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Envoyer
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
