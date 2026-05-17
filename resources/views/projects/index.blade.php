<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-zinc-900 dark:text-white leading-tight">
            {{ __('Collaboration Hub') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-8 flex flex-col md:flex-row gap-8">
        
        <!-- Main Content: Project List -->
        <div class="w-full md:w-2/3 space-y-8">
            @foreach ($projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="block">
                    <div class="bg-zinc-950 shadow-2xl rounded-3xl border border-zinc-800 p-8 transition-all duration-300 hover:border-zinc-500 hover:shadow-[0_0_40px_-15px_rgba(255,255,255,0.1)] relative overflow-hidden group hover:-translate-y-1">
                        <div class="absolute top-0 right-0 p-6 opacity-10 transform scale-150 group-hover:scale-[2] transition-transform duration-700">
                            <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13H5.5L12 6.5z"/></svg>
                        </div>

                        <div class="flex justify-between items-start mb-6 relative z-10">
                            <div>
                                <h4 class="text-3xl font-black text-white group-hover:text-zinc-300 transition-colors">{{ $project->title }}</h4>
                                <p class="text-sm text-zinc-400 mt-2">Founder: <span class="font-bold text-white">{{ $project->user->name }}</span> &bull; {{ $project->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="px-4 py-1.5 text-xs font-black tracking-wider rounded-xl shadow-lg border {{ $project->status == 'open' ? 'bg-zinc-900 text-white border-zinc-700' : 'bg-zinc-900 text-zinc-500 border-zinc-800' }}">
                                {{ strtoupper($project->status) }}
                            </span>
                        </div>

                        <p class="text-zinc-300 leading-relaxed text-lg mb-6 relative z-10">{{ $project->description }}</p>
                        
                        @if($project->required_skills)
                        <div class="mt-6 pt-6 border-t border-zinc-800 relative z-10">
                            <strong class="text-xs uppercase tracking-widest text-zinc-500 font-bold block mb-3">Roles / Skills Required</strong>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $project->required_skills) as $skill)
                                    <span class="bg-zinc-900 text-white border border-zinc-700 px-4 py-1.5 rounded-full text-xs font-bold shadow-sm">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </a>
            @endforeach

            @if($projects->isEmpty())
                 <div class="text-center py-16 bg-zinc-950 rounded-3xl border border-dashed border-zinc-800 shadow-xl">
                    <h3 class="mt-2 text-lg font-bold text-white">No Projects Found</h3>
                    <p class="mt-2 text-zinc-500">Be the first to list a collaborative project!</p>
                </div>
            @endif
        </div>

        <!-- Sidebar: Add Project Form -->
        <div class="w-full md:w-1/3">
            <div class="bg-zinc-950 rounded-3xl shadow-2xl border border-zinc-800 p-8 text-white sticky top-10">
                <h3 class="text-2xl font-black mb-6 text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Post Project
                </h3>
                <form action="{{ route('projects.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="relative group">
                        <label class="block text-xs uppercase tracking-widest font-bold mb-1 text-zinc-500 transition-colors group-focus-within:text-white">Project Title</label>
                        <input type="text" name="title" required class="w-full bg-transparent border border-zinc-600 rounded-xl text-white text-lg focus:ring-0 focus:border-white transition-colors px-4 py-3 placeholder-zinc-700" placeholder="e.g. EcoTrace AI">
                    </div>
                    <div class="relative group">
                        <label class="block text-xs uppercase tracking-widest font-bold mb-1 text-zinc-500 transition-colors group-focus-within:text-white">Vision & Description</label>
                        <textarea name="description" rows="3" required class="w-full bg-transparent border border-zinc-600 rounded-xl text-white text-lg focus:ring-0 focus:border-white transition-colors px-4 py-3 placeholder-zinc-700 resize-none" placeholder="Describe your vision..."></textarea>
                    </div>
                    <div class="relative group">
                        <label class="block text-xs uppercase tracking-widest font-bold mb-1 text-zinc-500 transition-colors group-focus-within:text-white">Required Skills</label>
                        <input type="text" name="required_skills" class="w-full bg-transparent border border-zinc-600 rounded-xl text-white text-lg focus:ring-0 focus:border-white transition-colors px-4 py-3 placeholder-zinc-700" placeholder="e.g. Laravel, React, Marketing">
                        <input type="hidden" name="status" value="open">
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full block text-center bg-white text-black font-black uppercase tracking-widest py-4 px-4 border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                            Find Co-Founders
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
