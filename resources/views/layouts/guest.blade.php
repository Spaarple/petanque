<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" href="{{ asset('/storage/' . config('site.logo_path')) }}" type="image/png">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
    <footer class="bg-gray-700 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
            <div class="xl:grid grid-cols-3 gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <img src="{{ asset('/storage/' . config('site.logo_path')) }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
                    <p class="text-gray-400 text-base">
                        Rejoignez-nous pour des événements inoubliables et explorez le meilleur des tournois.
                    </p>
                    <div class="flex space-x-6">
                        <!-- Add your social media links here -->
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <span class="sr-only">Facebook</span>
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <span class="sr-only">Instagram</span>
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-300">
                            <span class="sr-only">Twitter</span>
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Ressources
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="{{ route('user.albums.index') }}" class="text-base text-gray-300 hover:text-white">
                                        Albums
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                                Suivez-nous
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    {{-- mail to --}}
                                    <a href="mailto:{{ config('site.contact_email') }}" class="text-base text-gray-300 hover:text-white">
                                        Contact
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.contacts.messages') }}" class="text-base text-gray-300 hover:text-white">
                                        Messages
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8">
                <p class="text-base text-gray-400 xl:text-center">
                    &copy; 2024 {{ config('app.name') }}. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>
    
</html>
