<x-app-layout>
    <div class="min-h-screen bg-zinc-100 dark:bg-zinc-950 text-zinc-200 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto">
            <div class="mb-12 text-center">
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4">
                    Document Templates Library
                </h1>
                <p class="text-lg text-zinc-400 max-w-2xl mx-auto">Community-vetted, standard templates for your venture. Download, customize, and save thousands in legal fees.</p>
            </div>

            @forelse($templates as $category => $categoryTemplates)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-zinc-800 flex items-center justify-center text-white border border-zinc-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        </div>
                        {{ $category }}
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($categoryTemplates as $template)
                            <div class="group rounded-2xl bg-zinc-900 border border-zinc-800 p-6 hover:border-zinc-600 transition-all shadow-lg">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 bg-zinc-100 dark:bg-zinc-950 rounded-xl text-white group-hover:scale-110 transition-transform border border-zinc-800">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <button class="text-xs font-semibold text-zinc-400 hover:text-black bg-zinc-800 hover:bg-white px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1 border border-zinc-700">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        DL
                                    </button>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">{{ $template->title }}</h3>
                                <p class="text-sm text-zinc-400 line-clamp-2">{{ $template->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-zinc-900 rounded-3xl border-2 border-dashed border-zinc-800">
                    <h3 class="text-xl text-zinc-400">No templates available yet.</h3>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
