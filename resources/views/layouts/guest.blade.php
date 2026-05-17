<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'VentureHub'))</title>

    <!-- Fonts -->
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
<body class="h-full font-sans antialiased bg-zinc-100 dark:bg-zinc-950 text-zinc-950 dark:text-zinc-100 min-h-screen flex selection:bg-zinc-950 dark:selection:bg-white selection:text-white dark:selection:text-black transition-colors duration-300">

    <!-- Theme Toggle -->
    <div class="absolute top-4 right-4 z-50">
        <button 
            x-data="{ 
                theme: localStorage.theme || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
                toggleTheme() {
                    this.theme = this.theme === 'dark' ? 'light' : 'dark';
                    localStorage.theme = this.theme;
                    if (this.theme === 'dark') {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            }"
            @click="toggleTheme()"
            class="p-2 rounded-full bg-zinc-200 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-300 dark:hover:bg-zinc-700 transition-colors focus:outline-none shadow-md"
            aria-label="Toggle Theme"
        >
            <svg x-show="theme === 'dark'" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <svg x-show="theme !== 'dark'" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
        </button>
    </div>

    <!-- Left Side: Form -->
    <div class="flex-1 flex flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 w-full lg:w-1/2">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <!-- Logo -->
            <div class="mb-10 text-center lg:text-left">
                <a href="/" class="inline-flex items-center space-x-2 group">
                    <svg class="h-10 w-10 text-zinc-950 dark:text-white transition-transform duration-200 group-hover:scale-105" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="text-2xl font-display font-bold text-zinc-950 dark:text-white">
                        Venture<span class="text-zinc-500">Hub</span>
                    </span>
                </a>
            </div>

            <!-- Card/Form Content -->
            <div class="bg-white dark:bg-zinc-900/80 backdrop-blur-3xl border border-zinc-200 dark:border-zinc-800 shadow-2xl rounded-3xl px-8 py-10">
                {{ $slot }}
            </div>
        </div>
    </div>

    <!-- Right Side: Image -->
    <div class="hidden lg:block relative flex-1 w-0">
        <div class="absolute inset-0 h-full w-full object-cover">
            <img src="{{ asset('images/auth_split_bg.png') }}" class="h-full w-full object-cover grayscale" alt="VentureHub Background">
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    </div>

</body>
</html>
