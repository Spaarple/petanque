{{-- Exemple dans la vue show du tournoi --}}

{{-- ... affichage des détails du tournoi ... --}}

<div class="bg-white p-6 rounded shadow-xl">
    <h2 class="text-xl font-bold mb-4">Inscription au tournoi</h2>
    <form action="{{ route('admin.participants.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tournoi_id" value="{{ $tournoi->id }}">

        <div id="participants-form-list">
            <!-- Bloc de formulaire pour un participant -->
            <div class="participant-form">
                <input type="text" name="participants[0][first_name]" placeholder="Prénom" required>
                <input type="text" name="participants[0][last_name]" placeholder="Nom" required>
                <input type="email" name="participants[0][email]" placeholder="Email" required>
                <input type="text" name="participants[0][phone]" placeholder="Téléphone" required>
                <!-- ... autres champs si nécessaire ... -->
            </div>
        </div>

        <button type="button" id="add-participant">Ajouter un autre participant</button>
        <button type="submit">S'inscrire</button>
    </form>
</div>

<script>
    // Script JavaScript pour ajouter dynamiquement des formulaires de participants
    document.getElementById('add-participant').addEventListener('click', function() {
        var participantsList = document.getElementById('participants-form-list');
        var newParticipant = document.querySelector('.participant-form').cloneNode(true);
        var formCount = participantsList.getElementsByClassName('participant-form').length;
        newParticipant.innerHTML = newParticipant.innerHTML.replace(/\[0\]/g, '[' + formCount + ']');
        participantsList.appendChild(newParticipant);
    });
</script>
