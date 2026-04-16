<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400 leading-tight">
            {{ __('Collaboration Hub') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8 flex flex-col md:flex-row gap-8">
        
        <!-- Main Content: Project List -->
        <div class="w-full md:w-2/3 space-y-8">
            @foreach ($projects as $project)
                <div class="bg-gray-800/40 backdrop-blur-xl shadow-2xl rounded-3xl border border-gray-700/50 p-8 transition-all duration-300 hover:shadow-cyan-500/10 hover:border-gray-600/50 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-6 opacity-10 transform scale-150 group-hover:scale-[2] transition-transform duration-700">
                        <svg class="w-32 h-32 text-cyan-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13H5.5L12 6.5z"/></svg>
                    </div>

                    <div class="flex justify-between items-start mb-6 relative z-10">
                        <div>
                            <h4 class="text-3xl font-black text-gray-100 group-hover:text-cyan-400 transition-colors">{{ $project->title }}</h4>
                            <p class="text-sm text-gray-400 mt-2">Founder: <a href="{{ route('network.show', $project->user) }}" class="font-bold text-cyan-400 hover:text-cyan-300 transition">{{ $project->user->name }}</a> &bull; {{ $project->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-4 py-1.5 text-xs font-black tracking-wider rounded-xl shadow-lg {{ $project->status == 'open' ? 'bg-cyan-500/20 text-cyan-300 border border-cyan-500/30' : 'bg-red-500/20 text-red-300 border border-red-500/30' }}">
                            {{ strtoupper($project->status) }}
                        </span>
                    </div>

                    <p class="text-gray-300 leading-relaxed text-lg mb-6 relative z-10">{{ $project->description }}</p>
                    
                    @if($project->required_skills)
                    <div class="mt-6 pt-6 border-t border-gray-700/50 relative z-10">
                        <strong class="text-xs uppercase tracking-widest text-gray-500 font-bold block mb-3">Roles / Skills Required</strong>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $project->required_skills) as $skill)
                                <span class="bg-gray-900/80 text-cyan-300 border border-cyan-500/30 px-4 py-1.5 rounded-full text-xs font-bold shadow-sm backdrop-blur-sm">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            @endforeach

            @if($projects->isEmpty())
                 <div class="text-center py-16 bg-gray-800/30 backdrop-blur-xl rounded-3xl border border-dashed border-gray-700/50">
                    <h3 class="mt-2 text-lg font-bold text-gray-300">No Projects Found</h3>
                    <p class="mt-2 text-gray-500">Be the first to list a collaborative project!</p>
                </div>
            @endif
        </div>

        <!-- Sidebar: Add Project Form -->
        <div class="w-full md:w-1/3">
            <div class="bg-gray-900/60 backdrop-blur-2xl rounded-3xl shadow-2xl border border-gray-700/50 p-8 text-white sticky top-28 before:absolute before:inset-0 before:rounded-3xl before:bg-gradient-to-b before:from-cyan-500/10 before:to-transparent before:pointer-events-none">
                <h3 class="text-2xl font-black mb-6 text-cyan-400 flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Post Project
                </h3>
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-bold mb-2 text-gray-400">Project Title</label>
                        <input type="text" name="title" required class="w-full rounded-xl border-gray-700 bg-gray-800/80 text-white focus:border-cyan-500 focus:ring-cyan-500 transition px-4 py-3">
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-bold mb-2 text-gray-400">Vision & Description</label>
                        <textarea name="description" rows="4" required class="w-full rounded-xl border-gray-700 bg-gray-800/80 text-white focus:border-cyan-500 focus:ring-cyan-500 transition px-4 py-3"></textarea>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold mb-2 text-gray-400">Required Skills (Comma separated)</label>
                        <input type="text" name="required_skills" placeholder="e.g. Laravel, React, Marketing" class="w-full rounded-xl border-gray-700 bg-gray-800/80 text-white focus:border-cyan-500 focus:ring-cyan-500 transition px-4 py-3">
                        <input type="hidden" name="status" value="open">
                    </div>
                    <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-400 text-gray-900 font-black py-3 px-4 rounded-xl shadow-lg shadow-cyan-500/30 transition transform hover:-translate-y-1">
                        Find Co-Founders
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
