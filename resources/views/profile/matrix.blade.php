<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-zinc-900 dark:text-white leading-tight">
            {{ __('Entrepreneur Profile') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 mt-10">
            
        {{-- Profile Header Card --}}
        <div class="relative overflow-hidden rounded-3xl bg-zinc-950 border border-zinc-800 shadow-2xl mb-8">
            <div class="relative p-8 sm:p-12 flex flex-col sm:flex-row items-center sm:items-start gap-8">
                {{-- Avatar --}}
                <div class="relative">
                    <div class="w-32 h-32 rounded-full overflow-hidden border border-zinc-700 bg-zinc-900 shadow-xl">
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover grayscale">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-4xl font-black text-white">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="absolute bottom-0 right-0 w-8 h-8 bg-green-500 rounded-full border-4 border-zinc-950"></div>
                </div>

                {{-- Info --}}
                <div class="flex-1 text-center sm:text-left">
                    <h1 class="text-4xl font-black text-white mb-2 flex items-center justify-center sm:justify-start gap-3">
                        {{ $user->name }}
                        @if($user->is_verified)
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20" title="Verified Member"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        @endif
                    </h1>
                    <p class="text-xl text-zinc-400 font-bold mb-4 uppercase tracking-widest text-sm">
                        {{ $user->profile?->role ?? 'Innovator & Builder' }}
                    </p>
                    
                    <p class="text-zinc-300 text-lg leading-relaxed max-w-2xl">
                        {{ $user->profile?->bio ?? $user->bio ?? 'Ready to build the next big thing. Looking for complementary skills to turn vision into reality.' }}
                    </p>

                    <div class="mt-8 flex flex-wrap justify-center sm:justify-start gap-4">
                        @if(auth()->id() !== $user->id)
                            <form action="{{ route('connections.store', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-8 py-3 rounded-xl bg-white text-black font-black uppercase tracking-widest border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                                    Connect
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('pitches.create') }}" class="px-8 py-3 rounded-xl bg-zinc-900 text-white font-black uppercase tracking-widest border border-zinc-700 transition hover:bg-zinc-800">
                            Pitch Idea
                        </a>
                    </div>
                </div>

                {{-- Connection Stats --}}
                <div class="hidden lg:flex flex-col items-end justify-center space-y-4">
                    <div class="text-right">
                        <div class="text-4xl font-black text-white">{{ $mutualConnections }}</div>
                        <div class="text-sm text-zinc-500 uppercase tracking-widest font-bold mt-1">Mutual</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Skill / Need Matrix --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            {{-- Skills (What I Bring) --}}
            <div class="rounded-3xl bg-zinc-950 border border-zinc-800 p-8 sm:p-10 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-white group-hover:bg-zinc-400 transition-colors"></div>
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-3 bg-zinc-900 border border-zinc-800 rounded-xl text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-black text-white tracking-widest uppercase">What I Bring</h2>
                </div>

                <div class="flex flex-wrap gap-3">
                    @forelse($user->skills as $skill)
                        <div class="px-5 py-2.5 rounded-full bg-zinc-900 border border-zinc-700 text-white font-bold flex items-center gap-2 hover:bg-zinc-800 transition cursor-default group/skill">
                            <span>{{ $skill->name }}</span>
                            @if($skill->pivot->proficiency)
                                <span class="text-xs px-2 py-0.5 rounded-full bg-zinc-800 text-zinc-400 border border-zinc-700">
                                    {{ $skill->pivot->proficiency }}
                                </span>
                            @endif
                            
                            @php
                                $endorsementCount = \App\Models\SkillEndorsement::where('endorsee_id', $user->id)->where('skill_id', $skill->id)->count();
                            @endphp
                            @if($endorsementCount > 0)
                                <span class="text-xs font-black bg-white text-black px-2 py-0.5 rounded-full ml-1">+{{ $endorsementCount }}</span>
                            @endif
                            
                            @if(auth()->check() && auth()->id() !== $user->id)
                                <form action="{{ route('endorsements.store', ['user' => $user->id, 'skill' => $skill->id]) }}" method="POST" class="hidden group-hover/skill:block ml-2">
                                    @csrf
                                    <button type="submit" class="text-xs bg-zinc-700 hover:bg-white hover:text-black text-white px-3 py-1 rounded-full transition font-bold">Endorse</button>
                                </form>
                            @endif
                        </div>
                    @empty
                        <div class="w-full py-10 text-center border-2 border-dashed border-zinc-800 rounded-2xl text-zinc-600 font-bold">
                            No skills added to the matrix yet.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Needs (What I'm Looking For) --}}
            <div class="rounded-3xl bg-zinc-950 border border-zinc-800 p-8 sm:p-10 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-zinc-500 group-hover:bg-white transition-colors"></div>
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-3 bg-zinc-900 border border-zinc-800 rounded-xl text-zinc-400">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h2 class="text-2xl font-black text-zinc-400 tracking-widest uppercase group-hover:text-white transition-colors">What I Need</h2>
                </div>

                <div class="space-y-4">
                    @forelse($user->needs as $need)
                        <div class="p-5 rounded-2xl bg-zinc-900 border border-zinc-800 hover:border-zinc-600 transition">
                            <div class="font-black text-white mb-2 text-lg">{{ $need->name }}</div>
                            @if($need->pivot->description)
                                <p class="text-sm text-zinc-400 leading-relaxed">{{ $need->pivot->description }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="w-full py-10 text-center border-2 border-dashed border-zinc-800 rounded-2xl text-zinc-600 font-bold">
                            No needs specified yet.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
