<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 leading-tight">
            {{ __('Networking Feed') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <!-- Flash Message -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="mb-4 bg-green-500/20 border border-green-500/50 text-green-200 px-4 py-3 rounded-xl relative shadow-lg shadow-green-500/10" role="alert">
                <span class="block sm:inline font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Pitch Idea Form -->
        <div class="bg-gray-800/40 backdrop-blur-2xl overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-700/50 p-8 transition-all duration-300 hover:bg-gray-800/60 ring-1 ring-white/5 relative group">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl"></div>
            <h3 class="text-xl font-bold text-gray-100 mb-6 flex items-center relative z-10">
                <svg class="w-6 h-6 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Drop an Idea or Seek Feedback
            </h3>
            <form action="{{ route('posts.store') }}" method="POST" class="relative z-10">
                @csrf
                <div class="mb-5">
                    <input type="text" name="title" placeholder="A catchy title..." class="w-full rounded-xl border-gray-700/50 bg-gray-900/50 text-gray-100 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner transition px-4 py-3 text-lg">
                </div>
                <div class="mb-5">
                    <textarea name="content" rows="3" placeholder="Describe what you are working on or what you need..." class="w-full rounded-xl border-gray-700/50 bg-gray-900/50 text-gray-100 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500 shadow-inner transition px-4 py-3"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-bold py-3 px-8 rounded-full shadow-lg shadow-purple-500/30 transform transition hover:scale-105 hover:shadow-purple-500/50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-indigo-500">
                        Broadcast Pitch
                    </button>
                </div>
            </form>
        </div>

        <!-- Feed List -->
        <div class="space-y-8">
            @foreach ($posts as $post)
                <div class="bg-gray-800/40 backdrop-blur-2xl shadow-xl rounded-3xl border border-gray-700/50 p-8 transition-all duration-300 hover:bg-gray-800/60 ring-1 ring-white/5 relative">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-xl shadow-lg ring-2 ring-gray-900">
                                {{ substr($post->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-100 transition-colors hover:text-indigo-400">
                                    <a href="{{ route('network.show', $post->user) }}">{{ $post->user->name }}</a>
                                </h4>
                                <p class="text-xs text-gray-400 font-medium">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 mb-3">{{ $post->title }}</h5>
                    <p class="text-gray-300 leading-relaxed text-lg mb-8">{{ $post->content }}</p>

                    <!-- Comments Section -->
                    <div class="border-t border-gray-700/50 pt-5 mt-5">
                        <h6 class="text-sm font-semibold text-gray-400 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            Feedback ({{ $post->comments->count() }})
                        </h6>
                        <div class="space-y-4 mb-6">
                            @foreach ($post->comments as $comment)
                                <div class="bg-gray-900/60 rounded-2xl p-4 text-sm flex space-x-3 border border-gray-700/30">
                                    <span class="font-bold text-indigo-400 shrink-0">{{ $comment->user->name }}:</span>
                                    <span class="text-gray-300">{{ $comment->content }}</span>
                                </div>
                            @endforeach
                        </div>
                        
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex space-x-3">
                            @csrf
                            <input type="text" name="content" required placeholder="Share your insight..." class="flex-1 rounded-full border-gray-700/50 text-gray-100 bg-gray-900/80 focus:bg-gray-900 focus:ring-indigo-500 focus:border-indigo-500 px-6 py-3 transition shadow-inner">
                            <button type="submit" class="bg-indigo-500/20 text-indigo-300 hover:bg-indigo-500 hover:text-white border border-indigo-500/30 px-6 py-2 rounded-full font-bold transition duration-300">Reply</button>
                        </form>
                    </div>
                </div>
            @endforeach
            
            @if($posts->isEmpty())
                <div class="text-center py-16 bg-gray-800/30 backdrop-blur-xl rounded-3xl border border-dashed border-gray-700/50">
                    <svg class="mx-auto h-16 w-16 text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                    <h3 class="text-lg font-bold text-gray-300">No pitches have landed yet</h3>
                    <p class="mt-2 text-gray-500">The stage is yours. Pitch an idea to the community!</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
