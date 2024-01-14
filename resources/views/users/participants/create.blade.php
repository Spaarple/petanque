<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="bg-white p-6 rounded shadow-xl">
            <h2 class="text-xl font-bold mb-4">Inscription au tournoi : {{ $tournoi->tournoi_name }}</h2>
            <form action="{{ route('admin.participants.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="tournoi_id" value="{{ $tournoi->id }}">

                <div id="participants-form-list" class="space-y-4">
                    <div class="participant-form flex flex-between items-center">
                        <input type="text" name="participants[0][first_name]" placeholder="Prénom" class="p-2 border rounded m-2 flex-grow" required>
                        <input type="text" name="participants[0][last_name]" placeholder="Nom" class="p-2 border rounded m-2 flex-grow" required>
                        <input type="email" name="participants[0][email]" placeholder="Email" class="p-2 border rounded m-2 flex-grow" required>
                        <input type="text" name="participants[0][phone]" placeholder="Téléphone" class="p-2 border rounded m-2 flex-grow" required>
                    </div>
                </div>

                <div class="flex items-center space-x-4 mt-4">
                    <button type="button" id="add-participant" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 m-2 rounded">
                        Ajouter un autre participant
                    </button>
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 m-2 px-4 rounded">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-participant').addEventListener('click', function() {
            var participantsList = document.getElementById('participants-form-list');
            var newParticipant = document.querySelector('.participant-form').cloneNode(true);
            var formCount = participantsList.getElementsByClassName('participant-form').length;
            newParticipant.innerHTML = newParticipant.innerHTML.replace(/\[0\]/g, '[' + formCount + ']');
            participantsList.appendChild(newParticipant);
        });
    </script>
</x-app-layout>
