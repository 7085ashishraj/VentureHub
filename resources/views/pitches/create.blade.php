<x-app-layout>
    <div class="min-h-screen bg-slate-900 text-slate-200 py-12 px-4 font-sans">
        <div class="max-w-3xl mx-auto">
            <div class="rounded-3xl bg-slate-800/60 backdrop-blur-xl border border-slate-700 p-8 sm:p-12 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-3xl transform -translate-x-1/2 -translate-y-1/2"></div>
                
                <div class="relative">
                    <h2 class="text-3xl font-black text-white mb-2">Submit Your Pitch</h2>
                    <p class="text-slate-400 mb-8">Skip the slide deck. Give investors the structured data they want.</p>

                    <form action="{{ route('pitches.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-300 mb-2">Pitch Title</label>
                            <input type="text" name="title" required class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-slate-600" placeholder="E.g. Next-Gen AI Legal Assistant">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-300 mb-2">The Problem</label>
                            <textarea name="problem" required rows="3" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-slate-600" placeholder="What pain point are you solving?"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-emerald-400 mb-2">The Solution</label>
                            <textarea name="solution" required rows="4" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-slate-600" placeholder="How does your product solve the problem uniquely?"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-300 mb-2">Market Size & Target</label>
                                <textarea name="market" rows="3" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-slate-600"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-300 mb-2">The Ask</label>
                                <textarea name="ask" rows="3" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-slate-600" placeholder="E.g. Seeking $500k Seed, or a Technical Co-founder"></textarea>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-500 hover:to-teal-400 text-white font-bold text-lg shadow-[0_0_20px_rgba(16,185,129,0.4)] transition-all transform hover:-translate-y-1">
                                Publish Pitch to Deal Flow
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
