<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ auth()->user() && auth()->user()->dark_mode ? 'dark' : 'light' }}">


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

                    <!-- Toggle Switch -->
                    <a href="{{ route('toggle-dark-mode') }}" class="flex items-center cursor-pointer">
                        <div class="toggle-switch-container">
                            <input type="checkbox" id="toggleDarkMode" onclick="toggleDarkMode()">
                            <div class="toggle-switch"></div>
                            <div class="toggle-switch-dot"></div>
                        </div>
                    </a>
                </div>
                <style>
                    @keyframes slideLeft {
                        0% {
                            transform: translateX(0);
                        }

                        100% {
                            transform: translateX(-31px);
                        }
                    }

                    @keyframes slideRight {
                        0% {
                            transform: translateX(0);
                        }

                        100% {
                            transform: translateX(31px);
                        }
                    }

                    .toggle-switch-container {
                        position: relative;
                        display: inline-block;
                        margin: auto;
                    }

                    .toggle-switch {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 50px;
                        height: 20px;
                        background-color: #ccc;
                        border-radius: 10px;
                        cursor: pointer;
                        transition: background-color 0.3s;
                    }

                    .toggle-switch-dot {
                        position: absolute;
                        top: 2px;
                        left: {{ auth()->user() && auth()->user()->dark_mode ? '31px' : '2px' }};
                        width: 16px;
                        height: 16px;
                        background-color: white;
                        border-radius: 50%;
                        transition: left 0.3s, transform 0.3s;
                        animation: moveDot 3s forwards;
                        /* Added animation property */
                    }

                    @keyframes moveDot {
                        0% {
                            left: {{ auth()->user() && auth()->user()->dark_mode ? '2px' : '31px' }};
                        }

                        100% {
                            left: {{ auth()->user() && auth()->user()->dark_mode ? '31px' : '2px' }};
                        }
                    }

                    input[type="checkbox"] {
                        display: none;
                    }

                    input[type="checkbox"]:checked+.toggle-switch-dot {
                        left: {{ auth()->user() && auth()->user()->dark_mode ? '0' : '31px' }};
                        transform: translateX(0);
                    }
                </style>
                </head>

                <body>



                    <script>
                        function toggleDarkMode() {
                            // You can add AJAX logic here to update the dark mode status on the server
                            // For simplicity, I'm just updating the text content of the h1 element
                            var darkModeStatus = document.getElementById('darkModeStatus');
                            darkModeStatus.textContent = darkModeStatus.textContent === 'dark' ? 'light' : 'dark';
                        }
                    </script>

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
