<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('/storage/' . config('site.logo_path')) }}" alt="{{ config('app.name') }}" class="block h-10 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <!-- accueil, sponsor, Tournoi, album, forum, evenement, contact -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                    <!-- active id route is dashboard or contains admin -->
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard') || request()->routeIs('admin.*')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endauth

                    <x-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                        {{ __('Accueil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.sponsors.index')" :active="request()->routeIs('user.sponsors.*')">
                        {{ __('Partenaires') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.tournois.index')" :active="request()->routeIs('user.tournois.*')">
                        {{ __('Tournois') }}
                    </x-nav-link>
                    <x-nav-link :href="route('user.albums.index')" :active="request()->routeIs('user.albums.*')">
                        {{ __('Albums') }}
                    </x-nav-link>
                    @auth
                    @if(Auth::user()->is_approved == 1)
                    {{-- <x-nav-link :href="route('forums')" :active="request()->routeIs('forums')">
                        {{ __('Forums') }}
                    </x-nav-link> --}}
                    <x-nav-link :href="route('user.events.index')" :active="request()->routeIs('user.events.*')">
                        {{ __('Evenements') }}
                    </x-nav-link>
                    @endif
                    @endauth
                    <x-nav-link :href="route('user.contacts.messages')" :active="request()->routeIs('user.contacts.*')">
                        {{ __('Contacts') }}
                    </x-nav-link>
                    {{-- display joueur  --}}
                    @auth
                    @if(Auth::user()->is_approved == 1)
                    <x-nav-link :href="route('user.joueurs.index')" :active="request()->routeIs('user.joueurs.*')">
                        {{ __('Joueurs') }}
                    </x-nav-link>
                    @endif
                    @endauth

                </div>
            </div>
            @if (Route::has('login'))
                <!-- Settings Dropdown -->
                @auth
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    
                                        <div>{{ Auth::user()->name }}</div>
                                    
                                    
                                    <!-- Reste du bouton -->
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>  
                    @else
                    <div class="hidden space-x-7 sm:-my-px sm:ms-10 sm:flex">
                        
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Log in') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>



                            
                    </div>  
                        
                @endauth
            @endif

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
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
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @endauth
            <x-responsive-nav-link :href="route('accueil')" :active="request()->routeIs('accueil')">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.sponsors.index')" :active="request()->routeIs('user.sponsors.index')">
                {{ __('Partenaires') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.tournois.index')" :active="request()->routeIs('user.tournois.*')">
                {{ __('Tournois') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('user.albums.index')" :active="request()->routeIs('user.albums.*')">
                {{ __('Albums') }}
            </x-responsive-nav-link>
            @auth
            @if(Auth::user()->is_approved == 1)
            {{-- <x-responsive-nav-link :href="route('forums')" :active="request()->routeIs('forums')">
                {{ __('Forums') }}
            </x-responsive-nav-link> --}}
            <x-responsive-nav-link :href="route('user.events.index')" :active="request()->routeIs('user.event.*')">
                {{ __('Evenements') }}
            </x-responsive-nav-link>
            @endif
            @endauth
            <x-responsive-nav-link :href="route('user.contacts.messages')" :active="request()->routeIs('user.contact.*')">
                {{ __('Contacts') }}
            </x-responsive-nav-link>
            @auth
            @if(Auth::user()->is_approved == 1)
            <x-responsive-nav-link :href="route('user.joueurs.index')" :active="request()->routeIs('user.joueurs.*')">
                {{ __('Joueurs') }}
            </x-responsive-nav-link>
            @endif
            @endauth


        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            @if (Route::has('login'))
                @auth
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                            {{ Auth::user()->name }}
                        <div class="font-medium text-sm text-gray-500">
                            {{ Auth::user()->name }}</div>
                    </div>
                @endauth
            @endif
            
            <div class="mt-3 space-y-1">
                @if (Route::has('login'))
                    @auth
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                    @else
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Log in') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>
