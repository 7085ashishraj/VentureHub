@extends('layouts.public')
@section('title', 'VentureHub — Where Visionaries Connect')
@section('content')


{{-- ===== HERO ===== --}}
<section class="relative bg-zinc-950 overflow-hidden">

    {{-- Grid pattern background --}}
    <div class="absolute inset-0 -z-0 opacity-[0.04]"
         style="background-image: linear-gradient(rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,1) 1px, transparent 1px); background-size: 48px 48px;">
    </div>

    {{-- Accent blob --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-blue-600 opacity-10 rounded-full blur-3xl -z-0"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8 py-32 sm:py-44">
        <div class="max-w-4xl">

            {{-- Eyebrow --}}
            <div class="inline-flex items-center gap-3 mb-8 border border-zinc-800 bg-zinc-900/80 rounded-full px-5 py-2">
                <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Intelligent Matchmaking · Venture Rooms · Trusted Pipeline</span>
            </div>

            {{-- Main Heading --}}
            <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black text-white uppercase leading-none tracking-tight mb-8">
                Where<br>
                <span class="text-zinc-500">Visionaries</span><br>
                Connect.
            </h1>

            {{-- Divider bar --}}
            <div class="w-20 h-1.5 bg-blue-600 mb-8"></div>

            <p class="text-zinc-400 font-bold text-lg max-w-2xl mb-12 leading-relaxed">
                The intelligent networking platform for founders, investors, and collaborators.
                Smart matchmaking, purpose-built venture rooms, and a trusted deal pipeline — all in one place.
            </p>

            {{-- CTAs --}}
            <div class="flex flex-wrap items-center gap-5">
                <a href="{{ route('register') }}"
                    class="px-10 py-4 rounded-xl bg-white text-black font-black uppercase tracking-widest text-sm transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                    Apply for Access →
                </a>
                <a href="#features"
                    class="px-10 py-4 rounded-xl bg-transparent text-white font-black uppercase tracking-widest text-sm border border-zinc-700 hover:bg-zinc-900 transition-colors">
                    Explore Platform ↓
                </a>
            </div>

            {{-- Trust badges --}}
            <div class="mt-16 flex flex-wrap items-center gap-8">
                <div class="flex items-center gap-2.5 border border-zinc-800 rounded-xl px-4 py-2.5 bg-zinc-900/60">
                    <svg class="w-4 h-4 text-green-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">No credit card required</span>
                </div>
                <div class="flex items-center gap-2.5 border border-zinc-800 rounded-xl px-4 py-2.5 bg-zinc-900/60">
                    <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Verified community</span>
                </div>
                <div class="flex items-center gap-2.5 border border-zinc-800 rounded-xl px-4 py-2.5 bg-zinc-900/60">
                    <svg class="w-4 h-4 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <span class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Instant access</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== STATS STRIP ===== --}}
<section class="bg-zinc-900 border-y border-zinc-800">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-4xl font-black text-white">500+</p>
                <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mt-1">Founders</p>
            </div>
            <div>
                <p class="text-4xl font-black text-white">120+</p>
                <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mt-1">Venture Rooms</p>
            </div>
            <div>
                <p class="text-4xl font-black text-white">$2M+</p>
                <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mt-1">Deals Closed</p>
            </div>
            <div>
                <p class="text-4xl font-black text-white">98%</p>
                <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mt-1">Match Rate</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== FEATURES ===== --}}
<section id="features" class="bg-zinc-50 py-28">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">

        <div class="mb-16">
            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.3em] mb-3">The VentureHub Ecosystem</p>
            <h2 class="text-5xl font-black text-zinc-900 uppercase tracking-widest leading-none">
                Everything<br><span class="text-zinc-400">You Need</span>
            </h2>
            <div class="mt-4 w-12 h-1 bg-blue-600"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Matchmaking --}}
            <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 group hover:-translate-y-2 hover:border-blue-600/50 transition-all duration-300 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-zinc-800 group-hover:bg-blue-600 transition-colors duration-300"></div>
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Intelligent Matchmaking</h3>
                <p class="text-sm text-zinc-400 font-bold leading-relaxed mb-6">
                    Our Skill Matrix algorithm connects you with the perfect co-founder, investor, or partner based on complementary skills and shared vision.
                </p>
                <a href="{{ route('register') }}" class="text-[10px] font-black text-blue-400 hover:text-white uppercase tracking-widest transition-colors">
                    Find Your Match →
                </a>
            </div>

            {{-- Venture Rooms --}}
            <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 group hover:-translate-y-2 hover:border-white/20 transition-all duration-300 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-zinc-800 group-hover:bg-white transition-colors duration-300"></div>
                <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="h-6 w-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Venture Rooms</h3>
                <p class="text-sm text-zinc-400 font-bold leading-relaxed mb-6">
                    Purpose-built collaborative spaces with kanban boards, milestone tracking, Lean Canvas, and integrated tools for every project stage.
                </p>
                <a href="{{ route('register') }}" class="text-[10px] font-black text-zinc-400 hover:text-white uppercase tracking-widest transition-colors">
                    Open A Room →
                </a>
            </div>

            {{-- Deal Pipeline --}}
            <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 group hover:-translate-y-2 hover:border-blue-600/50 transition-all duration-300 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-zinc-800 group-hover:bg-blue-600 transition-colors duration-300"></div>
                <div class="w-12 h-12 bg-zinc-800 border border-zinc-700 rounded-xl flex items-center justify-center mb-6 shadow-lg">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black text-white uppercase tracking-widest mb-4">Trusted Pipeline</h3>
                <p class="text-sm text-zinc-400 font-bold leading-relaxed mb-6">
                    A vetted exchange for pitches, investment opportunities, and professional services — backed by a built-in reputation and endorsement system.
                </p>
                <a href="{{ route('register') }}" class="text-[10px] font-black text-blue-400 hover:text-white uppercase tracking-widest transition-colors">
                    Explore Deals →
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section id="how-it-works" class="bg-zinc-950 py-28 border-t border-zinc-800">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mb-16">
            <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.3em] mb-3">Simple Process</p>
            <h2 class="text-5xl font-black text-white uppercase tracking-widest leading-none">
                How It<br><span class="text-zinc-500">Works</span>
            </h2>
            <div class="mt-4 w-12 h-1 bg-white"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
            <div class="border border-zinc-800 p-10 relative">
                <span class="text-7xl font-black text-zinc-800 mb-6 block leading-none">01</span>
                <h3 class="text-lg font-black text-white uppercase tracking-widest mb-3">Build Your Matrix</h3>
                <p class="text-zinc-500 font-bold text-sm leading-relaxed">List your skills, experience, and startup vision. Our algorithm creates your unique Skill Matrix profile.</p>
            </div>
            <div class="border border-zinc-800 p-10 bg-zinc-900 relative">
                <span class="text-7xl font-black text-zinc-700 mb-6 block leading-none">02</span>
                <h3 class="text-lg font-black text-white uppercase tracking-widest mb-3">Get Matched</h3>
                <p class="text-zinc-500 font-bold text-sm leading-relaxed">Receive intelligent co-founder and investor matches. Connect, message, and build trust in the community.</p>
            </div>
            <div class="border border-zinc-800 p-10 relative">
                <span class="text-7xl font-black text-zinc-800 mb-6 block leading-none">03</span>
                <h3 class="text-lg font-black text-white uppercase tracking-widest mb-3">Launch & Scale</h3>
                <p class="text-zinc-500 font-bold text-sm leading-relaxed">Open a Venture Room, track milestones, post pitches to the Deal Pipeline, and close your first deal.</p>
            </div>
        </div>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section class="bg-zinc-50 py-28 border-t border-zinc-200">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-16 text-center relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600 opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white opacity-5 rounded-full blur-2xl"></div>

            <div class="relative z-10">
                <p class="text-[10px] font-black text-zinc-500 uppercase tracking-[0.3em] mb-4">Join the Movement</p>
                <h2 class="text-5xl font-black text-white uppercase tracking-widest leading-none mb-6">
                    Ready to Build<br><span class="text-zinc-400">Something Great?</span>
                </h2>
                <div class="w-12 h-1 bg-blue-600 mx-auto mb-8"></div>
                <p class="text-zinc-400 font-bold max-w-xl mx-auto mb-12 leading-relaxed">
                    Join ambitious founders already connecting, collaborating, and closing deals on VentureHub.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-5">
                    <a href="{{ route('register') }}"
                        class="px-10 py-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest text-sm transition-all shadow-[6px_6px_0px_0px_rgba(37,99,235,0.4)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                        Get Started Free →
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-10 py-4 rounded-xl bg-transparent text-white font-black uppercase tracking-widest text-sm border border-zinc-700 hover:bg-zinc-900 transition-colors">
                        Log In
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

