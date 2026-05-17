<aside 
    x-data="{ 
        expanded: true,
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
    :class="expanded ? 'w-64' : 'w-20'"
    class="bg-zinc-100 dark:bg-zinc-950 border-r border-zinc-200 dark:border-zinc-800 transition-all duration-500 ease-in-out flex flex-col h-full relative z-20 shadow-xl group overflow-hidden"
>
    <!-- Logo Section -->
    <div class="h-20 flex items-center justify-center border-b border-zinc-200 dark:border-zinc-800 transition-all duration-500">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 overflow-hidden whitespace-nowrap">
            <div class="shrink-0 flex items-center justify-center w-10 h-10 rounded-xl bg-zinc-950 dark:bg-white text-white dark:text-black shadow-lg transform transition-transform duration-500 hover:rotate-12">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span 
                x-show="expanded"
                x-transition:enter="transition ease-out duration-300 delay-100"
                x-transition:enter-start="opacity-0 translate-x-4"
                x-transition:enter-end="opacity-100 translate-x-0"
                class="text-2xl font-display font-black text-zinc-950 dark:text-white tracking-tight"
            >
                Venture<span class="text-zinc-500">Hub</span>
            </span>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-3 px-3 space-y-0.5 scrollbar-hide">

        <!-- Section: General -->
        <template x-if="expanded">
            <div class="px-2 pt-1 pb-1">
                <p class="text-[9px] font-black text-zinc-400 dark:text-zinc-600 uppercase tracking-widest">General</p>
            </div>
        </template>

        {{-- Landing Page --}}
        <x-sidebar-link href="/" :active="request()->is('/')" icon="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z M9 21V12h6v9">
            {{ __('Home') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
            {{ __('Feed') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('projects.index')" :active="request()->routeIs('projects.*')" icon="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
            {{ __('Collaboration Hub') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('events.index')" :active="request()->routeIs('events.*')" icon="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
            {{ __('Events') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('network.index')" :active="request()->routeIs('network.*')" icon="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
            {{ __('Entrepreneurs') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('connections.index')" :active="request()->routeIs('connections.*')" icon="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
            {{ __('My Connections') }}
        </x-sidebar-link>

        <x-sidebar-link :href="route('messages.index')" :active="request()->routeIs('messages.*')" icon="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
            {{ __('Messages') }}
        </x-sidebar-link>

        <!-- Divider between sections -->
        <div class="border-t border-zinc-200 dark:border-zinc-800 my-1"></div>

        <!-- Section: Workspace label (only when expanded) -->
        <template x-if="expanded">
            <div class="px-2 pb-1">
                <p class="text-[9px] font-black text-zinc-400 dark:text-zinc-600 uppercase tracking-widest">Workspace</p>
            </div>
        </template>

        {{-- Skill Matrix --}}
        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')" icon="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
            {{ __('Skill Matrix') }}
        </x-sidebar-link>

        {{-- Venture Rooms --}}
        <x-sidebar-link :href="route('venture-rooms.index')" :active="request()->routeIs('venture-rooms.*')" icon="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
            {{ __('Venture Rooms') }}
        </x-sidebar-link>

        {{-- Deal Pipeline --}}
        <x-sidebar-link :href="route('pitches.index')" :active="request()->routeIs('pitches.*')" icon="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
            {{ __('Deal Pipeline') }}
        </x-sidebar-link>

    </nav>

    <!-- Bottom Actions -->
    <div class="p-3 border-t border-zinc-200 dark:border-zinc-800 space-y-2 overflow-hidden">

        <!-- User Card: full link to profile -->
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 p-2 rounded-2xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 hover:border-blue-400 dark:hover:border-blue-600 transition-all duration-300 overflow-hidden w-full">
            <span class="shrink-0 flex items-center justify-center w-10 h-10 rounded-xl bg-zinc-200 dark:bg-zinc-800 text-zinc-950 dark:text-white font-bold text-lg border border-zinc-300 dark:border-zinc-700">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </span>
            <template x-if="expanded">
                <div class="overflow-hidden min-w-0">
                    <p class="text-sm font-bold text-zinc-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold text-zinc-500 uppercase tracking-widest">View Profile</p>
                </div>
            </template>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 p-3 rounded-xl bg-red-50 dark:bg-red-950/30 text-red-500 hover:bg-red-100 dark:hover:bg-red-900/40 border border-red-200 dark:border-red-900/50 transition-all duration-300 font-black uppercase tracking-widest text-[10px] overflow-hidden">
                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <template x-if="expanded">
                    <span>Sign Out</span>
                </template>
            </button>
        </form>

        <!-- Collapse Toggle + Theme Toggle Row (at the very bottom) -->
        <div class="flex gap-2 pt-1" :class="expanded ? 'flex-row' : 'flex-col'">
            <button 
                @click="expanded = !expanded" 
                class="flex-1 flex items-center justify-center p-2.5 rounded-xl bg-zinc-200 dark:bg-zinc-900 text-zinc-500 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-300 dark:hover:bg-zinc-800 transition-all duration-300"
            >
                <svg :class="expanded ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                </svg>
            </button>

            <button 
                @click="toggleTheme()"
                class="flex-1 flex items-center justify-center p-2.5 rounded-xl bg-zinc-200 dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 hover:bg-zinc-300 dark:hover:bg-zinc-800 transition-all duration-300"
            >
                <svg x-show="theme === 'dark'" style="display: none;" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <svg x-show="theme !== 'dark'" style="display: none;" class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>


    </div>
</aside>


