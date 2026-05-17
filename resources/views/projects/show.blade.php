<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center text-zinc-900 dark:text-zinc-400 hover:text-black dark:hover:text-white transition font-bold text-lg">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Collaboration Hub
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Project Header --}}
            <div class="relative overflow-hidden rounded-3xl bg-zinc-950 border border-zinc-800 shadow-2xl p-8 sm:p-12">
                <div class="absolute inset-0 bg-gradient-to-br from-zinc-800/20 via-zinc-900/10 to-transparent opacity-50"></div>
                
                <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-4xl sm:text-5xl font-black text-white mb-4">
                            {{ $project->title }}
                        </h1>
                        <div class="flex items-center gap-4 text-zinc-500">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Founded by <a href="{{ route('network.show', $project->user) }}" class="text-white hover:underline">{{ $project->user->name }}</a>
                            </span>
                            <span>&bull;</span>
                            <span>{{ $project->created_at->format('M d, Y') }}</span>
                            @if($project->ventureStage)
                                <span>&bull;</span>
                                <span class="text-white bg-zinc-800 px-3 py-1 rounded-full text-xs font-bold border border-zinc-700">{{ $project->ventureStage->name }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        @auth
                            @if(auth()->id() !== $project->user_id)
                                @if($project->joinedUsers->contains(auth()->id()))
                                    <form action="{{ route('projects.join', $project) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-6 py-3 rounded-xl bg-zinc-800 text-white font-bold border border-zinc-700 hover:bg-zinc-700 transition">
                                            Leave Project
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('projects.join', $project) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-6 py-3 rounded-xl bg-white text-black font-black uppercase tracking-widest border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                                            Join Project
                                        </button>
                                    </form>
                                @endif
                            @else
                                <span class="px-6 py-3 rounded-xl bg-zinc-900 text-zinc-500 font-bold border border-zinc-800 cursor-not-allowed">
                                    Project Founder
                                </span>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-3 rounded-xl bg-white text-black font-black uppercase tracking-widest border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                                Login to Join
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Main Details --}}
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-8 shadow-2xl">
                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Vision & Description
                        </h2>
                        <div class="text-zinc-300 leading-relaxed space-y-4 text-lg">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    </div>

                    @if($project->required_skills)
                        <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-8 shadow-2xl">
                            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Required Skills
                            </h2>
                            <div class="flex flex-wrap gap-3">
                                @foreach(explode(',', $project->required_skills) as $skill)
                                    <span class="bg-zinc-800 text-white border border-zinc-700 px-5 py-2 rounded-full font-bold shadow-sm">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar: Connected Users --}}
                <div class="space-y-8">
                    <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-8 shadow-2xl">
                        <h2 class="text-xl font-bold text-white mb-6 flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Connected Team
                            </span>
                            <span class="bg-white text-black font-bold px-3 py-1 rounded-full text-sm">{{ $project->joinedUsers->count() + 1 }}</span>
                        </h2>
                        
                        <div class="space-y-4">
                            {{-- Founder --}}
                            <div class="flex items-center gap-4 p-3 bg-zinc-900 rounded-2xl border border-zinc-800 relative overflow-hidden">
                                <div class="absolute right-0 top-0 bottom-0 w-1 bg-white"></div>
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-800 border border-zinc-700">
                                    @if($project->user->profile_image)
                                        <img src="{{ asset('storage/' . $project->user->profile_image) }}" class="w-full h-full object-cover grayscale">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-zinc-900 text-white font-bold">
                                            {{ substr($project->user->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('network.show', $project->user) }}" class="font-bold text-white hover:text-zinc-300 block">{{ $project->user->name }}</a>
                                    <span class="text-xs text-zinc-500 font-bold tracking-wider uppercase">Founder</span>
                                </div>
                            </div>

                            {{-- Joined Users --}}
                            @foreach($project->joinedUsers as $member)
                                <div class="flex items-center gap-4 p-3 hover:bg-zinc-800 rounded-2xl transition border border-transparent hover:border-zinc-700">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-800 border border-zinc-700">
                                        @if($member->profile_image)
                                            <img src="{{ asset('storage/' . $member->profile_image) }}" class="w-full h-full object-cover grayscale">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-zinc-800 text-zinc-300 font-bold">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('network.show', $member) }}" class="font-bold text-zinc-200 hover:text-white block">{{ $member->name }}</a>
                                        <span class="text-xs text-zinc-500 font-medium">Collaborator</span>
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($project->joinedUsers->isEmpty())
                                <p class="text-sm text-zinc-500 text-center py-4">No one has joined this project yet.</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
    </div>
</x-app-layout>
