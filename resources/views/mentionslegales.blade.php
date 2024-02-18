<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mentions Légales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6">
                <div class="space-y-6">
                    

                    <section>
                        <h3 class="font-bold text-xl text-blue-600 mb-2">Propriétaire du site</h3>
                        <p class="mb-1">Entité: Association Asce pétanque</p>
                        <p class="mb-1">Raison Sociale: Asce pétanque</p>
                        <p class="mb-1">Nom: Ferrandin</p>
                        <p class="mb-1">Prénom: August</p>
                        <p class="mb-1">Téléphone: +33 06 73 15 66 44</p>
                        <p class="mb-1">Email: guscar@orange.fr</p>
                    </section>

                    <section>
                        <h3 class="font-bold text-xl text-blue-600 mb-2">Éditeur du site</h3>
                        <p class="mb-1">Nom de l'éditeur: Louka Millon</p>
                        <p class="mb-1">Email: louka.millon.pro@gmail.com</p>

                    </section>

                    <section>
                        <h3 class="font-bold text-xl text-blue-600 mb-2">Hébergeur du site</h3>
                        <p class="mb-1">Nom de l'hébergeur: O2Switch</p>
                        <p class="mb-1">Adresse: CHE DES PARDIAUX, 63000 CLERMONT-FERRAND </p>
                        <p class="mb-1">Email: support@o2switch.fr
                        <p class="mb-1">Téléphone: 04 44 44 60 40
                        <p class="mb-1">Site web: <a href="https://www.o2switch.fr/">https://www.o2switch.fr/</a></p>
                    </section>

                    <section>
                        <h3 class="font-bold text-xl text-blue-600 mb-2">Conditions d'utilisation</h3>
                        <p>Le site est librement accessible à tous les utilisateurs. Un système de login est destiné aux personnes faisant partie du club.</p>
                    </section>

                    <section>
                        <h3 class="font-bold text-xl text-blue-600 mb-2">Politique de confidentialité</h3>
                        <p>L’utilisation du site implique l’acceptation pleine et entière des conditions générales d’utilisation décrites ci-dessus. Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment.</p>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
