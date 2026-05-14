<x-app-layout>
    <div class="min-h-screen bg-slate-900 text-slate-200 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto">
            <div class="mb-12 text-center">
                <h1 class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-500 mb-4">
                    Document Templates Library
                </h1>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto">Community-vetted, standard templates for your venture. Download, customize, and save thousands in legal fees.</p>
            </div>

            @forelse($templates as $category => $categoryTemplates)
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center text-indigo-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        </div>
                        {{ $category }}
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($categoryTemplates as $template)
                            <div class="group rounded-2xl bg-slate-800/40 backdrop-blur-sm border border-slate-700/50 p-6 hover:bg-slate-800 hover:border-indigo-500/50 transition-all shadow-lg hover:shadow-indigo-500/10">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 bg-slate-900 rounded-xl text-indigo-400 group-hover:text-indigo-300 group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <button class="text-xs font-semibold text-slate-400 hover:text-white bg-slate-700/50 hover:bg-indigo-600 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        DL
                                    </button>
                                </div>
                                <h3 class="text-xl font-bold text-slate-100 mb-2">{{ $template->title }}</h3>
                                <p class="text-sm text-slate-400 line-clamp-2">{{ $template->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-slate-800/20 rounded-3xl border-2 border-dashed border-slate-700">
                    <h3 class="text-xl text-slate-400">No templates available yet.</h3>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
