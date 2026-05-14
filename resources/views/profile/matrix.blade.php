<x-app-layout>
    <div class="min-h-screen bg-slate-900 text-slate-200 py-12 px-4 sm:px-6 lg:px-8 font-sans selection:bg-indigo-500 selection:text-white">
        <div class="max-w-5xl mx-auto">
            
            {{-- Profile Header Card --}}
            <div class="relative overflow-hidden rounded-3xl bg-slate-800/50 backdrop-blur-xl border border-slate-700/50 shadow-2xl mb-8 group">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 via-purple-500/10 to-pink-500/10 opacity-50 group-hover:opacity-100 transition duration-700"></div>
                
                <div class="relative p-8 sm:p-12 flex flex-col sm:flex-row items-center sm:items-start gap-8">
                    {{-- Avatar --}}
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-indigo-500/30 shadow-[0_0_30px_rgba(99,102,241,0.3)]">
                            @if($user->profile_image)
                                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-4xl font-bold text-white">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div class="absolute bottom-0 right-0 w-8 h-8 bg-green-400 rounded-full border-4 border-slate-800 shadow-[0_0_15px_rgba(74,222,128,0.5)]"></div>
                    </div>

                    {{-- Info --}}
                    <div class="flex-1 text-center sm:text-left">
                        <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 via-purple-300 to-pink-300 mb-2 flex items-center gap-3">
                            {{ $user->name }}
                            @if($user->is_verified)
                                <svg class="w-8 h-8 text-blue-400" fill="currentColor" viewBox="0 0 20 20" title="Verified Member"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            @endif
                        </h1>
                        <p class="text-xl text-indigo-300 font-medium mb-4">
                            {{ $user->profile?->role ?? 'Innovator & Builder' }}
                        </p>
                        
                        <p class="text-slate-400 text-lg leading-relaxed max-w-2xl">
                            {{ $user->profile?->bio ?? $user->bio ?? 'Ready to build the next big thing. Looking for complementary skills to turn vision into reality.' }}
                        </p>

                        <div class="mt-6 flex flex-wrap justify-center sm:justify-start gap-4">
                            <button class="px-6 py-2.5 rounded-full bg-indigo-500 hover:bg-indigo-400 text-white font-semibold transition-all shadow-[0_0_20px_rgba(99,102,241,0.4)] hover:shadow-[0_0_30px_rgba(99,102,241,0.6)] transform hover:-translate-y-1">
                                Connect
                            </button>
                            <button class="px-6 py-2.5 rounded-full bg-slate-700/50 hover:bg-slate-600/50 text-slate-200 border border-slate-600 font-semibold transition-all hover:border-slate-500 backdrop-blur-md">
                                Pitch Idea
                            </button>
                        </div>
                    </div>

                    {{-- Connection Stats --}}
                    <div class="hidden lg:flex flex-col items-end justify-center space-y-4">
                        <div class="text-right">
                            <div class="text-3xl font-black text-white">{{ $mutualConnections }}</div>
                            <div class="text-sm text-slate-400 uppercase tracking-wider font-semibold">Mutual</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Skill / Need Matrix --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Skills (What I Bring) --}}
                <div class="rounded-3xl bg-slate-800/40 backdrop-blur-lg border border-indigo-500/20 p-8 shadow-xl hover:bg-slate-800/60 transition duration-500 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-indigo-400 to-purple-500 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-3 bg-indigo-500/20 rounded-2xl text-indigo-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white tracking-wide">What I Bring</h2>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        @forelse($user->skills as $skill)
                            <div class="px-4 py-2 rounded-xl bg-slate-900/80 border border-indigo-500/30 text-indigo-300 font-medium flex items-center gap-2 hover:bg-indigo-500/10 hover:border-indigo-400 transition cursor-default group/skill">
                                <span>{{ $skill->name }}</span>
                                @if($skill->pivot->proficiency)
                                    <span class="text-xs px-2 py-0.5 rounded-full bg-indigo-500/20 text-indigo-200">
                                        {{ $skill->pivot->proficiency }}
                                    </span>
                                @endif
                                
                                @php
                                    $endorsementCount = \App\Models\SkillEndorsement::where('endorsee_id', $user->id)->where('skill_id', $skill->id)->count();
                                @endphp
                                @if($endorsementCount > 0)
                                    <span class="text-xs font-bold bg-yellow-500/20 text-yellow-400 px-2 py-0.5 rounded-full border border-yellow-500/30 ml-1">+{{ $endorsementCount }}</span>
                                @endif
                                
                                @if(auth()->check() && auth()->id() !== $user->id)
                                    <form action="{{ route('endorsements.store', ['user' => $user->id, 'skill' => $skill->id]) }}" method="POST" class="hidden group-hover/skill:block ml-2">
                                        @csrf
                                        <button type="submit" class="text-xs bg-slate-700 hover:bg-indigo-500 text-white px-2 py-0.5 rounded transition">Endorse</button>
                                    </form>
                                @endif
                            </div>
                        @empty
                            <div class="w-full py-8 text-center border-2 border-dashed border-slate-700 rounded-2xl text-slate-500">
                                No skills added to the matrix yet.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Needs (What I'm Looking For) --}}
                <div class="rounded-3xl bg-slate-800/40 backdrop-blur-lg border border-pink-500/20 p-8 shadow-xl hover:bg-slate-800/60 transition duration-500 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-pink-400 to-rose-500 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-3 bg-pink-500/20 rounded-2xl text-pink-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white tracking-wide">What I Need</h2>
                    </div>

                    <div class="space-y-4">
                        @forelse($user->needs as $need)
                            <div class="p-4 rounded-2xl bg-slate-900/80 border border-pink-500/20 hover:border-pink-500/40 transition">
                                <div class="font-semibold text-pink-300 mb-1">{{ $need->name }}</div>
                                @if($need->pivot->description)
                                    <p class="text-sm text-slate-400">{{ $need->pivot->description }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="w-full py-8 text-center border-2 border-dashed border-slate-700 rounded-2xl text-slate-500">
                                No needs specified yet.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
