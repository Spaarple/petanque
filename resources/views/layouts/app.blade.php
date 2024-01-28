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

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen  max-w-full mx-auto bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <!-- if auth and admin and page = dashboard or admin.* -->
        @if (Auth::check() && Auth::user()->role == 'admin')
            @if (Route::currentRouteName() == 'dashboard' || Str::startsWith(Route::currentRouteName(), 'admin.'))
                @include('layouts.admin-navigation')
            @endif
        @endif


        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="overflow-x-hidden">
            {{ $slot }}
        </main>
    </div>
    <!-- Include JavaScript sections from Blade views -->
    @yield('javascript')
</body>

</html>
