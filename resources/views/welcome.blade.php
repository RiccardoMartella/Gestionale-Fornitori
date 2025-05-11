<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gestionale Fornitori</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <!-- CSS links -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        
        <!-- Scripts -->
        @viteReactRefresh
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Homepage specific styles -->
        <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <img src="{{ asset('pane.png') }}" class="h-24 w-auto" alt="Logo Gestione Fornitori">
                </div>
                
                <div class="mt-8 text-center">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Gestionale Fornitori</h1>
                    <p class="mt-4 text-xl text-gray-600 dark:text-gray-400">
                        Benvenuto nel sistema di gestione fornitori
                    </p>
                </div>
                
                @if (Route::has('login'))
                    <div class="mt-8 flex justify-center gap-4">
                        @auth
                            <a href="{{ url('/suppliers') }}" class="btn-secondary">
                                <span>Dashboard</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-secondary">
                                <span>Log in</span>
                            </a>

                            {{-- @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-primary">
                                    <span>Register</span>
                                </a>
                            @endif --}}
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
