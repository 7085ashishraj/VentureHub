<x-app-layout>
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 mt-10">
        
        <!-- Profile Header -->
        <div class="bg-gray-800/40 backdrop-blur-2xl shadow-2xl rounded-[3rem] overflow-hidden border border-gray-700/50 relative">
            <div class="h-64 bg-gradient-to-r from-orange-500 via-pink-500 to-purple-600 opacity-80 mix-blend-screen relative">
                <div class="absolute inset-0 bg-gray-900/40"></div>
            </div>
            
            <div class="px-10 pb-10 flex flex-col md:flex-row items-start md:items-end relative -mt-24 gap-8">
                <!-- Avatar -->
                <div class="h-40 w-40 md:h-48 md:w-48 rounded-full border-8 border-gray-900 bg-gray-800 flex items-center justify-center text-6xl font-black text-gray-300 shadow-2xl overflow-hidden flex-shrink-0 relative z-10 group">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-pink-500 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                    @if($user->profile_image)
                        <img src="{{ $user->profile_image }}" class="object-cover h-full w-full relative z-10">
                    @else
                        <span class="relative z-10 group-hover:text-white transition">{{ substr($user->name, 0, 1) }}</span>
                    @endif
                </div>

                <!-- Info -->
                <div class="flex-1 pb-4">
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-2">{{ $user->name }}</h1>
                    @if($user->skills)
                        <p class="text-pink-400 font-bold text-lg mb-4">{{ $user->skills }}</p>
                    @endif
                    <div class="flex space-x-6 mt-4">
                        @if($user->linkedin)
                            <a href="{{ $user->linkedin }}" target="_blank" class="text-gray-400 hover:text-white transition font-medium flex items-center gap-2 bg-gray-900/50 px-4 py-2 rounded-full border border-gray-700 hover:border-gray-500">
                                <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                LinkedIn
                            </a>
                        @endif
                        @if($user->github)
                            <a href="{{ $user->github }}" target="_blank" class="text-gray-400 hover:text-white transition font-medium flex items-center gap-2 bg-gray-900/50 px-4 py-2 rounded-full border border-gray-700 hover:border-gray-500">
                                <svg class="w-5 h-5 text-gray-100" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                GitHub
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Action Button -->
                <div class="md:ml-auto pb-4">
                    @if(Auth::id() !== $user->id)
                        <button class="bg-white text-gray-900 font-black py-3 px-8 rounded-full shadow-lg shadow-white/10 hover:shadow-white/20 hover:-translate-y-1 transition transform text-lg">
                            Message
                        </button>
                    @endif
                </div>
            </div>

            <!-- About Section -->
            <div class="px-10 py-8 border-t border-gray-700/50 bg-gray-900/60 backdrop-blur-3xl relative z-20">
                <h3 class="text-xl font-bold text-gray-200 mb-4 flex items-center gap-2">
                    <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    About the Founder
                </h3>
                <p class="text-gray-400 leading-relaxed max-w-4xl text-lg">
                    {{ $user->bio ?? 'Silent builder.' }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12 mb-12">
            <!-- Projects list -->
            <div>
                <h3 class="text-2xl font-black text-cyan-400 mb-6 flex items-center gap-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    Open Projects
                </h3>
                <div class="space-y-6">
                    @forelse($user->projects as $project)
                        <div class="bg-gray-800/40 backdrop-blur-xl rounded-3xl p-8 shadow-xl border border-gray-700/50 hover:border-cyan-500/30 transition group">
                            <h4 class="text-xl font-bold text-gray-100 group-hover:text-cyan-400 transition">{{ $project->title }}</h4>
                            <p class="text-gray-400 mt-3 mb-5 leading-relaxed">{{ Str::limit($project->description, 120) }}</p>
                            <span class="text-xs font-black tracking-widest bg-gray-900/80 px-4 py-2 rounded-full text-cyan-400 border border-cyan-500/20">{{ strtoupper($project->status) }}</span>
                        </div>
                    @empty
                        <div class="p-8 border border-dashed border-gray-700 rounded-3xl text-center">
                            <p class="text-gray-500 font-medium">No projects pitched yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Pitches / Posts -->
            <div>
                <h3 class="text-2xl font-black text-indigo-400 mb-6 flex items-center gap-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                    Recent Feed Activity
                </h3>
                <div class="space-y-6">
                    @forelse($user->posts->take(5) as $post)
                        <div class="bg-gray-800/40 backdrop-blur-xl rounded-3xl p-8 shadow-xl border border-gray-700/50 hover:border-indigo-500/30 transition group">
                            <h4 class="text-xl font-bold text-gray-100 group-hover:text-indigo-400 transition mb-3">{{ $post->title }}</h4>
                            <p class="text-gray-400 leading-relaxed">{{ Str::limit($post->content, 120) }}</p>
                        </div>
                    @empty
                        <div class="p-8 border border-dashed border-gray-700 rounded-3xl text-center">
                            <p class="text-gray-500 font-medium">No pitches posted yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
