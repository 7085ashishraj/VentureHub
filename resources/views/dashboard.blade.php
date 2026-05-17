<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-display font-bold text-2xl text-zinc-900 dark:text-zinc-100 leading-tight">
                {{ __('Networking Feed') }}
            </h2>
            <span class="text-xs text-zinc-400 font-medium bg-zinc-900 border border-zinc-800 rounded-full px-3 py-1">
                Your VentureHub Dashboard
            </span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

        {{-- Feature Cards Row --}}
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3 mb-8">

            {{-- Card 1: Skill Matrix --}}
            <a href="{{ route('profile.edit') }}" class="block group bg-zinc-950 overflow-hidden rounded-3xl border border-zinc-800 transition-all duration-300 hover:border-zinc-600 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                <div class="p-8 sm:p-10">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="flex-shrink-0 bg-white rounded-xl p-2.5">
                            <svg class="h-5 w-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Skill Matrix</h3>
                    </div>
                    <p class="text-base text-zinc-200 leading-relaxed mt-2">Update your skills to get smart matchmaking suggestions.</p>
                    <div class="mt-6">
                        <span class="inline-flex items-center gap-1 text-sm font-bold text-white group-hover:text-zinc-300 transition-colors">
                            Edit Profile <span>→</span>
                        </span>
                    </div>
                </div>
            </a>

            {{-- Card 2: Venture Rooms --}}
            <a href="{{ route('venture-rooms.index') }}" class="block group bg-zinc-950 overflow-hidden rounded-3xl border border-zinc-800 transition-all duration-300 hover:border-zinc-600 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                <div class="p-8 sm:p-10">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="flex-shrink-0 bg-white rounded-xl p-2.5">
                            <svg class="h-5 w-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Venture Rooms</h3>
                    </div>
                    <p class="text-base text-zinc-200 leading-relaxed mt-2">Collaborative spaces with kanban boards and file sharing.</p>
                    <div class="mt-6">
                        <span class="inline-flex items-center gap-1 text-sm font-bold text-white group-hover:text-zinc-300 transition-colors">
                            View Rooms <span>→</span>
                        </span>
                    </div>
                </div>
            </a>

            {{-- Card 3: Deal Pipeline --}}
            <a href="{{ route('pitches.index') }}" class="block group bg-zinc-950 overflow-hidden rounded-3xl border border-zinc-800 transition-all duration-300 hover:border-zinc-600 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                <div class="p-8 sm:p-10">
                    <div class="flex items-center space-x-3 mb-3">
                        <div class="flex-shrink-0 bg-white rounded-xl p-2.5">
                            <svg class="h-5 w-5 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white">Deal Pipeline</h3>
                    </div>
                    <p class="text-base text-zinc-200 leading-relaxed mt-2">Browse pitches, find investors, and offer your services.</p>
                    <div class="mt-6">
                        <span class="inline-flex items-center gap-1 text-sm font-bold text-white group-hover:text-zinc-300 transition-colors">
                            Explore Pipeline <span>→</span>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-2 bg-green-500/15 border border-green-500/40 text-green-300 px-4 py-3 rounded-xl shadow-lg" role="alert">
                <span class="block sm:inline font-semibold text-sm">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Pitch Idea Form --}}
        <div class="bg-zinc-950 overflow-hidden shadow-2xl rounded-3xl border border-zinc-800 p-10 sm:p-12 transition-all duration-300 relative group">
            <h3 class="text-xl font-bold text-zinc-100 mb-6 flex items-center relative z-10">
                <svg class="w-6 h-6 mr-3 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Drop an Idea or Seek Feedback
            </h3>
            <form action="{{ route('posts.store') }}" method="POST" class="relative z-10">
                @csrf
                <div class="mb-5">
                    <input type="text" name="title" placeholder="A catchy title..."
                        class="w-full rounded-xl border-zinc-700 bg-zinc-950 text-white placeholder-zinc-500 focus:border-white focus:ring-white transition px-4 py-3 text-lg">
                </div>
                <div class="mb-5">
                    <textarea name="content" rows="3" placeholder="Describe what you are working on or what you need..."
                        class="w-full rounded-xl border-zinc-700 bg-zinc-950 text-white placeholder-zinc-500 focus:border-white focus:ring-white transition px-4 py-3"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-white text-black font-bold py-3 px-8 rounded-xl shadow-lg transition hover:bg-zinc-200">
                        Broadcast Pitch
                    </button>
                </div>
            </form>
        </div>

        {{-- Feed List --}}
        <div class="space-y-8">
            @foreach ($posts as $post)
                <div class="bg-zinc-950 shadow-2xl rounded-3xl border border-zinc-800 p-10 sm:p-12 transition-all duration-300 relative">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 rounded-full bg-zinc-800 flex items-center justify-center text-white font-bold text-xl shadow-lg border border-zinc-700">
                                {{ strtoupper(substr($post->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-zinc-100 transition-colors hover:text-white">
                                    <a href="{{ route('network.show', $post->user) }}">{{ $post->user->name }}</a>
                                </h4>
                                <p class="text-xs text-zinc-400 font-medium">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-2xl font-bold text-white mb-3">{{ $post->title }}</h5>
                    <p class="text-zinc-300 leading-relaxed text-lg mb-8">{{ $post->content }}</p>

                    {{-- Comments Section --}}
                    <div class="border-t border-zinc-800 pt-5 mt-5">
                        <h6 class="text-sm font-semibold text-zinc-400 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Feedback ({{ $post->comments->count() }})
                        </h6>
                        <div class="space-y-4 mb-6">
                            @foreach ($post->comments as $comment)
                                <div class="bg-zinc-800 rounded-2xl p-4 text-sm flex space-x-3 border border-zinc-700">
                                    <span class="font-bold text-white shrink-0">{{ $comment->user->name }}:</span>
                                    <span class="text-zinc-300">{{ $comment->content }}</span>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex space-x-3">
                            @csrf
                            <input type="text" name="content" required placeholder="Share your insight..."
                                class="flex-1 rounded-xl border-zinc-700 text-white bg-zinc-950 focus:ring-white focus:border-white px-6 py-3 transition">
                            <button type="submit"
                                class="bg-white text-black hover:bg-zinc-200 border border-transparent px-6 py-2 rounded-xl font-bold transition duration-300">
                                Reply
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            @if($posts->isEmpty())
                <div class="text-center py-16 bg-gray-800/30 backdrop-blur-xl rounded-3xl border border-dashed border-gray-700/50">
                    <svg class="mx-auto h-16 w-16 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-lg font-bold text-gray-300">No pitches have landed yet</h3>
                    <p class="mt-2 text-gray-500">The stage is yours. Pitch an idea to the community!</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
