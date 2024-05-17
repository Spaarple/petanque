<x-app-layout>

    <div class="background-carousel container-fluid bg-white shadow">
        <div class="row">
            <div class="col-12 flex justify-center items-center h-screen " style="height: 300px;">
                <h1 class="text-4xl font-bold leading-tight text-gray-900">{{ config('app.name', 'Laravel') }}</h1>
            </div>
        </div>
    </div>

    <section class="container-fluid bg-gray-200 mx-auto p-4">
        <div class="container-fluid py-4  bg-gray-200">
            <!-- if no tournois find in the database -->
            @if ($tournois->isEmpty())
                <h2 class="text-2xl font-bold text-center mb-6">Aucun concours à venir</h2>
            @else
                <a href="/tournois/{{ $tournois[0]->id }}">
                <div class=" flex items-center justify-center container-fluid">
                    <div class="flex flex-col w-full bg-white rounded-lg shadow-lg sm:w-3/4 md:w-1/2 lg:w-3/5">
                        <div class="flex flex-col w-full md:flex-row">
                            <div class="flex flex-row justify-around p-4 font-bold leading-none text-gray-200
                            uppercase bg-gray-700 rounded-none sm:rounded-l-lg md:flex-col md:items-center md:justify-center md:w-1/4">
                                @php
                                    \Carbon\Carbon::setLocale('fr');
                                    $date = \Carbon\Carbon::parse($tournois[0]->tournoi_start_date);
                                    $numberDate = $date->translatedFormat('j'); // Samedi 13
                                    $jour = strtoupper(substr($date->translatedFormat('l j'), 0, 3)); // DIM, LUN, etc.
                                    $mois = substr($date->translatedFormat('F'), 0, 4); // Janv, avec ajustement manuel si nécessaire
                                    // get hour and minute
                                    $heure = $date->format('H:i');
                                @endphp
                                <div class="md:text-3xl">{{$jour}}</div>
                                <div class="md:text-3xl">{{$numberDate}} {{$mois}}</div>
                                <div class="md:text-xl">{{$heure}}</div>
                            </div>
                            <div class="p-4 font-normal text-gray-800 md:w-3/4">
                                <h1 class="mb-4 text-4xl font-bold leading-none tracking-tight text-gray-800">{{ $tournois[0]->tournoi_name }}</h1>
                                <p class="leading-normal">{{ $tournois[0]->tournoi_description }}</p>
                                <div class="flex flex-row items-center mt-4 text-gray-700">
                                    <div class="w-1/2 text-2xl">{{ $tournois[0]->tournoi_location }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            @endif
        </div>
    </section>

    <div class="container-fluid mx-auto bg-grey-50 p-4 mb-5">
        <h2 class="text-2xl font-bold text-center mb-3">Partenaires</h2>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <!-- Boucle sur les sponsors -->
                @foreach ($sponsors->chunk(3) as $sponsorChunk)
                    <div class="swiper-slide">
                        <div class="flex flex-wrap">
                            @foreach ($sponsorChunk as $sponsor)
                                <div class="w-full md:w-1/3">
                                    <a href="/sponsors/{{ $sponsor->id }}">
                                    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl px-8 pb-8 pt-40 max-w-sm mx-auto mt-10">
                                        <img src="{{ asset( 'storage/' . $sponsor->sponsor_logo) }}" alt="{{ $sponsor->sponsor_name }}"
                                             class="absolute inset-0 h-full w-full object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                                        <h3 class="z-10 mt-3 text-3xl font-bold text-white">{{ $sponsor->sponsor_name }}</h3>
                                        <div class="z-10 gap-y-1 overflow-hidden text-sm leading-6 text-gray-300">
                                            {{ Str::words($sponsor->sponsor_description, 10, '...') }}
                                        </div>
                                    </article>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center mt-6">
            <a href="/sponsors" class="text-blue-600 hover:text-blue-800 font-bold">Voir tous les Partenaires</a>
        </div>
    </div>

    <div class="bg-gray-200">
        <div class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 py-16 sm:px-6 sm:py-16 lg:max-w-7xl lg:grid-cols-2 lg:px-8">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Club de Pétanque de la Baule-Escoublac</h2>
                <p class="mt-4 text-gray-500">{!! $textContent->content !!}</p>
            </div>
            <div class="grid grid-cols-1 grid-rows-0 gap-0 sm:gap-2 lg:gap-4">
                <div class="w-full ">
                    <iframe width="100%" height="250" style="border:0"
                            src="https://www.openstreetmap.org/export/embed.html?bbox=-2.3803000%2C47.2997000%2C-2.331100%2C47.278000&layer=mapnik&marker=47.29549%2C-2.35371"
                            allowfullscreen class="rounded-lg">
                    </iframe>
                </div>
                {{-- fixed image --}}
                <img src="{{ asset('images/bureau.jpg') }}"
                     class="w-full h-64 object-cover rounded-lg shadow-lg mt-4" alt="bureau">
            </div>
        </div>
    </div>

    <section class="container-fluid bg-grey-50 mx-auto p-4">
        <div class="container mx-auto p-6">
            <h2 class="text-2xl font-bold text-center mb-6">Contactez-nous</h2>
            <form action="{{ route('user.contacts.store') }}" method="POST" class="w-3/4 mx-auto">
                @csrf <!-- Ajout du token CSRF -->
                <!-- Condition: Si l'utilisateur n'est pas connecté, afficher ce champ -->
                @if (Auth::check())
                    <!-- Champ e-mail visible seulement pour les utilisateurs non connectés -->
                    <div class="mb-4">
                        <label for="contact_sender_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="contact_sender_email" id="contact_sender_email"
                            value="{{ Auth::user()->email }}" readonly
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                @else
                    <div class="mb-4">
                        <label for="contact_sender_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="contact_sender_email" id="contact_sender_email" required
                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                @endif

                <div class="mb-4">
                    <label for="contact_sender_object" class="block text-sm font-medium text-gray-700">Objet</label>
                    <input type="text" name="contact_sender_object" id="contact_sender_object" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="mb-6">
                    <label for="contact_sender_message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="contact_sender_message" id="contact_sender_message" required
                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Envoyer
                        le
                        message</button>

                </div>
            </form>
        </div>
    </section>

        <style>
            .background-carousel {
                background-size: cover;
                background-position: center;
                transition: background-image 0.5s ease-in-out;
                /* Transition douce entre les images */
            }
        </style>

        <script>
            let swiper = new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const images = [
                    @foreach ($carouselImages as $image)
                        "{{ asset($image->image_path) }}",
                    @endforeach
                ];
                let currentIndex = 0;
                const carouselDiv = document.querySelector('.background-carousel');
                carouselDiv.style.backgroundImage = `url('${images[images.length - 1]}')`;
                if (carouselDiv) {
                    setInterval(() => {
                        carouselDiv.style.backgroundImage = `url('${images[currentIndex]}')`;
                        currentIndex = (currentIndex + 1) % images.length;
                    }, 5000); // Change l'image toutes les 5 secondes
                } else {
                    console.error("Element '.background-carousel' not found");
                }

            });
        </script>
</x-app-layout>
