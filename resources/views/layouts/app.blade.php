<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'VentureHub'))</title>

    <!-- Fonts: Inter + Lexend from Bunny (GDPR-friendly Google Fonts mirror) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|lexend:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Dark Mode Init Script -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-zinc-950 dark:text-zinc-100 bg-zinc-100 dark:bg-zinc-950 min-h-screen relative selection:bg-zinc-950 dark:selection:bg-white selection:text-white dark:selection:text-black transition-colors duration-300">

    <div class="h-screen flex overflow-hidden">
        <!-- Sidebar Navigation -->
        @include('layouts.navigation')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col overflow-y-auto relative">
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-zinc-100 dark:bg-zinc-950 border-b border-zinc-200 dark:border-zinc-800 shadow-sm sticky top-0 z-10 transition-colors duration-300">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 py-10 relative z-0">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-zinc-100 dark:bg-zinc-950 border-t border-zinc-200 dark:border-zinc-800 py-6 mt-auto relative z-0">
                <div class="max-w-7xl mx-auto px-4 text-center text-sm text-zinc-500">
                    &copy; {{ date('Y') }}
                    <span class="font-display font-semibold text-zinc-700 dark:text-zinc-300">Venture<span class="text-zinc-950 dark:text-white">Hub</span></span>.
                    All rights reserved.
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
