<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account — VentureHub</title>
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
    <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col lg:flex-row border border-zinc-200">

        <!-- LEFT: Brand Panel -->
        <div class="relative lg:w-1/2 bg-zinc-950 flex flex-col justify-between overflow-hidden" style="min-height: 300px;">

            <!-- Background Image -->
            <img src="/images/auth-panel.png" alt="" class="absolute inset-0 w-full h-full object-cover opacity-60">

            <!-- Grid overlay -->
            <div class="absolute inset-0 opacity-10"
                 style="background-image: linear-gradient(rgba(255,255,255,0.3) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 32px 32px;">
            </div>

            <!-- Blue accent glow -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600 opacity-20 rounded-full blur-3xl"></div>

            <!-- Content Top -->
            <div class="relative z-10 p-10">
                <a href="/" class="inline-flex items-center gap-3">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-zinc-950" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-black text-white tracking-tight">Venture<span class="text-zinc-400">Hub</span></span>
                </a>
            </div>

            <!-- Content Bottom -->
            <div class="relative z-10 p-10">
                <p class="text-[10px] font-black text-blue-400 uppercase tracking-widest mb-3">Join the Movement</p>
                <h2 class="text-3xl font-black text-white uppercase leading-tight mb-4">
                    Build Your<br>Startup<br><span class="text-zinc-400">Empire.</span>
                </h2>
                <p class="text-zinc-400 font-bold text-sm leading-relaxed max-w-xs mb-8">
                    Connect with co-founders, open venture rooms, and pitch your idea to investors — all for free.
                </p>

                <!-- Feature List -->
                <ul class="space-y-3">
                    <li class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-[11px] font-black text-zinc-300 uppercase tracking-widest">AI-powered skill matching</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-[11px] font-black text-zinc-300 uppercase tracking-widest">Private venture rooms</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-[11px] font-black text-zinc-300 uppercase tracking-widest">Trusted deal pipeline</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-lg bg-zinc-800 flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-[11px] font-black text-zinc-500 uppercase tracking-widest">Free forever, no credit card</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- RIGHT: Register Form -->
        <div class="lg:w-1/2 flex flex-col justify-center px-8 py-10 sm:px-12 bg-zinc-950 dark:bg-zinc-900">
            <div class="max-w-sm w-full mx-auto">

                <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-2">Get Started</p>
                <h1 class="text-3xl font-black text-white uppercase tracking-tight mb-8">Create<br>Account.</h1>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                            class="w-full px-4 py-3 rounded-xl bg-zinc-900 dark:bg-zinc-800 border border-zinc-700 text-white font-bold text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                            placeholder="Ashish Raj">
                        @error('name')
                            <p class="mt-1 text-xs font-bold text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                            class="w-full px-4 py-3 rounded-xl bg-zinc-900 dark:bg-zinc-800 border border-zinc-700 text-white font-bold text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                            placeholder="you@example.com">
                        @error('email')
                            <p class="mt-1 text-xs font-bold text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password row -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="password" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Password</label>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-xl bg-zinc-900 dark:bg-zinc-800 border border-zinc-700 text-white font-bold text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                            @error('password')
                                <p class="mt-1 text-xs font-bold text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Confirm</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="w-full px-4 py-3 rounded-xl bg-zinc-900 dark:bg-zinc-800 border border-zinc-700 text-white font-bold text-sm placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest text-sm transition-all shadow-[5px_5px_0px_0px_rgba(37,99,235,0.3)] hover:shadow-none hover:translate-x-[5px] hover:translate-y-[5px] mt-2">
                        Create Account →
                    </button>

                    <!-- Divider -->
                    <div class="flex items-center gap-4">
                        <div class="flex-1 h-px bg-zinc-800"></div>
                        <span class="text-[10px] font-black text-zinc-600 uppercase tracking-widest">or</span>
                        <div class="flex-1 h-px bg-zinc-800"></div>
                    </div>

                    <!-- Login Link -->
                    <p class="text-center text-xs font-bold text-zinc-400">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-black transition-colors">Sign In →</a>
                    </p>
                </form>
            </div>
        </div>

    </div>
</div>

</body>
</html>
