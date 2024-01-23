<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ auth()->user() && auth()->user()->dark_mode ? 'dark' : 'light' }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')


        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
                <a href="{{ route('toggle-dark-mode') }}" class="px-3 py-2 rounded-md cursor-pointer">Toggle Dark
                    Mode</a>
                <h1>{{ auth()->user() && auth()->user()->dark_mode ? 'dark' : 'light' }}</h1>

            </header>
        @endif

        <!-- Page Content -->
        <div class="bg-white dark:bg-gray-800 text-black dark:text-white">
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
