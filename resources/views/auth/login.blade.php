<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In — VentureHub</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="h-full bg-zinc-100 dark:bg-zinc-950 font-sans antialiased transition-colors duration-300">

<!-- Theme Toggle -->
<div
    x-data="{
        theme: localStorage.theme || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'),
        toggleTheme() {
            this.theme = this.theme === 'dark' ? 'light' : 'dark';
            localStorage.theme = this.theme;
            document.documentElement.classList.toggle('dark', this.theme === 'dark');
        }
    }"
    class="fixed top-4 right-4 z-50"
>
    <button
        @click="toggleTheme()"
        class="flex items-center justify-center w-10 h-10 rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 shadow-lg hover:shadow-xl transition-all duration-300"
    >
        <svg x-show="theme === 'dark'" style="display:none" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        <svg x-show="theme !== 'dark'" style="display:none" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
    </button>
</div>

<div class="min-h-screen flex items-center justify-center p-4 sm:p-8">

    <!-- Center Card -->
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row border border-zinc-200" style="min-height: 580px;">

        <!-- LEFT: Brand Panel -->
        <div class="relative lg:w-1/2 bg-zinc-950 flex flex-col justify-between overflow-hidden" style="min-height: 300px;">

            <!-- Background Image -->
            <img src="/images/auth-panel.png" alt="" class="absolute inset-0 w-full h-full object-cover opacity-60">

            <!-- Grid overlay -->
            <div class="absolute inset-0 opacity-10"
                 style="background-image: linear-gradient(rgba(255,255,255,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 32px 32px;">
            </div>

            <!-- Blue accent glow -->
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-blue-600 opacity-20 rounded-full blur-3xl"></div>

            <!-- Content -->
            <div class="relative z-10 p-10">
                <!-- Logo -->
                <a href="/" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-zinc-950" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-black text-white tracking-tight">Venture<span class="text-zinc-400">Hub</span></span>
                </a>
            </div>

            <div class="relative z-10 p-10">
                <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3">Welcome Back</p>
                <h2 class="text-3xl font-black text-white uppercase leading-tight mb-4">
                    Where<br>Visionaries<br><span class="text-zinc-400">Connect.</span>
                </h2>
                <p class="text-zinc-400 font-bold text-sm leading-relaxed max-w-xs">
                    Smart matchmaking, venture rooms, and a trusted deal pipeline — all in one place.
                </p>

                <!-- Stats -->
                <div class="flex items-center gap-6 mt-8">
                    <div>
                        <p class="text-2xl font-black text-white">500+</p>
                        <p class="text-[9px] font-black text-zinc-500 uppercase tracking-widest">Founders</p>
                    </div>
                    <div class="w-px h-8 bg-zinc-800"></div>
                    <div>
                        <p class="text-2xl font-black text-white">$2M+</p>
                        <p class="text-[9px] font-black text-zinc-500 uppercase tracking-widest">Deals Closed</p>
                    </div>
                    <div class="w-px h-8 bg-zinc-800"></div>
                    <div>
                        <p class="text-2xl font-black text-white">98%</p>
                        <p class="text-[9px] font-black text-zinc-500 uppercase tracking-widest">Match Rate</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Login Form -->
        <div class="lg:w-1/2 flex flex-col justify-center px-8 py-12 sm:px-12 bg-zinc-950 dark:bg-zinc-900">

            <div class="max-w-sm w-full mx-auto">
                <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2">Sign In</p>
                <h1 class="text-3xl font-black text-white uppercase tracking-tight mb-8">Welcome<br>Back.</h1>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm font-bold text-green-600 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="w-full px-4 py-3 rounded-xl bg-zinc-900 dark:bg-zinc-800 border border-zinc-700 text-white font-bold text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                            placeholder="you@example.com">
                        @error('email')
                            <p class="mt-1.5 text-xs font-bold text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-black text-blue-400 hover:text-blue-300 uppercase tracking-widest transition-colors">Forgot?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-3 rounded-xl bg-zinc-900 dark:bg-zinc-800 border border-zinc-700 text-white font-bold text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1.5 text-xs font-bold text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center gap-3">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-zinc-600 bg-zinc-800 text-blue-600 focus:ring-blue-500 cursor-pointer">
                        <label for="remember_me" class="text-xs font-bold text-zinc-400 cursor-pointer select-none">Remember me for 30 days</label>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-3.5 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-white font-black uppercase tracking-widest text-sm transition-all shadow-[5px_5px_0px_0px_rgba(0,0,0,0.1)] hover:shadow-none hover:translate-x-[5px] hover:translate-y-[5px] mt-2">
                        Sign In →
                    </button>

                    <!-- Divider -->
                    <div class="flex items-center gap-4 my-2">
                        <div class="flex-1 h-px bg-zinc-800"></div>
                        <span class="text-[10px] font-black text-zinc-600 uppercase tracking-widest">or</span>
                        <div class="flex-1 h-px bg-zinc-800"></div>
                    </div>

                    <!-- Register Link -->
                    <p class="text-center text-xs font-bold text-zinc-400">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-black transition-colors">Create one →</a>
                    </p>
                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>
