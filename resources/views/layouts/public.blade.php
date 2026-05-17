<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'VentureHub - Where Visionaries Connect')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900|space-grotesk:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="h-full bg-zinc-50 font-sans antialiased">
<div class="flex min-h-full flex-col">

    <!-- Top Navbar -->
    <nav class="sticky top-0 z-50 bg-zinc-950 border-b border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 group">
                    <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-white text-black shadow-lg group-hover:scale-105 transition-transform">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-black text-white tracking-tight">Venture<span class="text-zinc-400">Hub</span></span>
                </a>

                <!-- Nav Links (center) -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="#features" class="text-[11px] font-black text-zinc-400 hover:text-white uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-zinc-900 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-[11px] font-black text-zinc-400 hover:text-white uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-zinc-900 transition-colors">How It Works</a>
                    @auth
                        <a href="{{ route('events.index') }}" class="text-[11px] font-black text-zinc-400 hover:text-white uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-zinc-900 transition-colors">Events</a>
                        <a href="{{ route('pitches.index') }}" class="text-[11px] font-black text-zinc-400 hover:text-white uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-zinc-900 transition-colors">Deal Flow</a>
                        <a href="{{ route('venture-rooms.index') }}" class="text-[11px] font-black text-zinc-400 hover:text-white uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-zinc-900 transition-colors">Rooms</a>
                    @endauth
                </div>

                <!-- CTA Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-xl bg-white text-black font-black text-xs uppercase tracking-widest transition-all shadow-[4px_4px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                            Dashboard →
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-[11px] font-black text-zinc-400 hover:text-white uppercase tracking-widest px-4 py-2 transition-colors hidden sm:block">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-widest transition-all shadow-[4px_4px_0px_0px_rgba(37,99,235,0.4)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                            Get Started
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-zinc-950 border-t border-zinc-800">
        <div class="mx-auto max-w-7xl px-6 py-10 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center w-8 h-8 rounded-xl bg-white text-black">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="font-black text-white text-sm tracking-tight">Venture<span class="text-zinc-400">Hub</span></span>
            </div>
            <div class="flex items-center gap-8">
                <a href="#features" class="text-[10px] font-black text-zinc-600 hover:text-white uppercase tracking-widest transition-colors">Features</a>
                <a href="{{ route('login') }}" class="text-[10px] font-black text-zinc-600 hover:text-white uppercase tracking-widest transition-colors">Log In</a>
                <a href="{{ route('register') }}" class="text-[10px] font-black text-zinc-600 hover:text-white uppercase tracking-widest transition-colors">Register</a>
            </div>
            <p class="text-[10px] font-black text-zinc-600 uppercase tracking-widest">&copy; {{ date('Y') }} VentureHub. All Rights Reserved.</p>
        </div>
    </footer>

</div>
</body>
</html>
