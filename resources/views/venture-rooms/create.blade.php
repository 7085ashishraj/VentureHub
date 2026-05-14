<x-app-layout>
    <div class="min-h-screen bg-slate-900 text-slate-200 py-12 px-4 font-sans flex items-center justify-center">
        <div class="max-w-2xl w-full">
            
            <div class="rounded-3xl bg-slate-800/60 backdrop-blur-xl border border-slate-700 p-8 sm:p-12 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
                
                <div class="relative">
                    <h2 class="text-3xl font-black text-white mb-2">Create Venture Room</h2>
                    <p class="text-slate-400 mb-8">Establish a secure, collaborative workspace for your startup idea.</p>

                    <form action="{{ route('venture-rooms.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Room Name</label>
                            <input type="text" name="name" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-inner placeholder-slate-600" placeholder="e.g. Project Phoenix">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-300 mb-2">Description</label>
                            <textarea name="description" rows="3" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-inner placeholder-slate-600" placeholder="What is the main objective of this venture?"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Link to Project (Optional)</label>
                                <select name="project_id" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                    <option value="">-- None --</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-300 mb-2">Current Stage</label>
                                <select name="venture_stage_id" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                                    <option value="">-- Select Stage --</option>
                                    @foreach($stages as $stage)
                                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold text-lg shadow-[0_0_20px_rgba(99,102,241,0.4)] transition-all transform hover:-translate-y-1">
                                Initialize Workspace
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
