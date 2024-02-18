<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->

                <!-- Navigation Links -->
                <!-- accueil, sponsor, Tournoi, album, forum, evenement, contact -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <!-- statistiques -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Accueil') }}
                    </x-nav-link>
                    @if(auth()->check() && auth()->user()->role == 'admin')
                    <x-nav-link :href="route('admin.sponsors.index')" :active="request()->routeIs('admin.sponsors.*')">
                        {{ __('Partenaires') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.tournois.index')" :active="request()->routeIs('admin.tournois.*') || request()->routeIs('admin.participants.*')">
                        {{ __('Tournois') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.albums.index')" :active="request()->routeIs('admin.albums.*')">
                        {{ __('Albums') }}
                    </x-nav-link>
                    {{-- <x-nav-link :href="route('forums')" :active="request()->routeIs('forums')">
                        {{ __('Forums') }}
                    </x-nav-link> --}}
                    <x-nav-link :href="route('admin.events.all')" :active="request()->routeIs('admin.events.*')">
                        {{ __('Evenements') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.contacts.index')" :active="request()->routeIs('admin.contacts.*')">
                        {{ __('Contacts') }}
                    </x-nav-link>
                    <!-- ajoute users -->
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Utilisateurs') }}
                    </x-nav-link>
                    {{-- statistiques --}}
                    <x-nav-link :href="route('admin.statistiques.index')" :active="request()->routeIs('admin.statistiques.*')">
                        {{ __('Statistiques') }}
                    </x-nav-link>
                    {{-- Paramètres --}}
                    <x-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.parametres.*')">
                        {{ __('Paramètres') }}
                    </x-nav-link>
                    @endif

                </div>
            </div>
            

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            @endauth
            {{-- if is admin --}}
            @if(auth()->check() && auth()->user()->role == 'admin')
            <x-responsive-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.sponsors.index')" :active="request()->routeIs('admin.sponsors.*')">
                {{ __('Partenaires') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.tournois.index')" :active="request()->routeIs('admin.tournois.*')">
                {{ __('Tournois') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.albums.index')" :active="request()->routeIs('admin.albums.*')">
                {{ __('Albums') }}
            </x-responsive-nav-link>
            {{-- <x-responsive-nav-link :href="route('forums')" :active="request()->routeIs('forums')">
                {{ __('Forums') }}
            </x-responsive-nav-link> --}}
            <x-responsive-nav-link :href="route('admin.events.all')" :active="request()->routeIs('admin.events.*')">
                {{ __('Evenements') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.contacts.index')" :active="request()->routeIs('admin.contacts.*')">
                {{ __('Contacts') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                {{ __('Utilisateurs') }}
            </x-responsive-nav-link>
            {{-- statistiques --}}
            <x-responsive-nav-link :href="route('admin.statistiques.index')" :active="request()->routeIs('admin.statistiques.*')">
                {{ __('Statistiques') }}
            </x-responsive-nav-link>
            {{-- Paramètres --}}
            <x-responsive-nav-link :href="route('admin.settings.index')" :active="request()->routeIs('admin.parametres.*')">
                {{ __('Paramètres') }}
            </x-responsive-nav-link>
            @endif


        </div>

       
    </div>
</nav>
