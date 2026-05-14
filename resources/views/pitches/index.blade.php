<x-app-layout>
    <div class="min-h-screen bg-slate-900 text-slate-200 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-12">
                <div>
                    <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-emerald-500 mb-2">
                        Deal Flow
                    </h1>
                    <p class="text-slate-400 text-lg">Structured pitches from verified entrepreneurs.</p>
                </div>
                <a href="{{ route('pitches.create') }}" class="px-6 py-3 rounded-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold shadow-[0_0_15px_rgba(16,185,129,0.4)] transition-all">
                    Submit Pitch
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($pitches as $pitch)
                    <div class="bg-slate-800/50 backdrop-blur-md rounded-3xl border border-slate-700/50 p-8 shadow-xl hover:bg-slate-800 transition duration-300 relative group">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-bl-full group-hover:scale-110 transition-transform"></div>
                        
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 rounded-full border-2 border-emerald-500/30 overflow-hidden">
                                @if($pitch->user->profile_image)
                                    <img src="{{ asset('storage/' . $pitch->user->profile_image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-slate-700 flex items-center justify-center font-bold text-white">{{ substr($pitch->user->name, 0, 1) }}</div>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-white flex items-center gap-2">
                                    {{ $pitch->user->name }}
                                    @if($pitch->user->is_verified)
                                        <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    @endif
                                </div>
                                <div class="text-xs text-slate-400">{{ $pitch->created_at->diffForHumans() }}</div>
                            </div>
                        </div>

                        <h2 class="text-2xl font-black text-white mb-4">{{ $pitch->title }}</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700/50">
                                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Problem</h3>
                                <p class="text-sm text-slate-300 line-clamp-2">{{ $pitch->problem }}</p>
                            </div>
                            <div class="bg-slate-900/50 p-4 rounded-xl border border-slate-700/50">
                                <h3 class="text-xs font-bold text-emerald-500 uppercase tracking-wider mb-1">Solution</h3>
                                <p class="text-sm text-slate-300 line-clamp-2">{{ $pitch->solution }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-6 pt-6 border-t border-slate-700/50">
                            <div>
                                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider">The Ask</h3>
                                <div class="text-emerald-400 font-bold">{{ $pitch->ask ?? 'Contact for details' }}</div>
                            </div>
                            <button class="text-sm bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded-lg font-semibold transition">View Details</button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center border-2 border-dashed border-slate-700 rounded-3xl text-slate-500">
                        <svg class="mx-auto h-12 w-12 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <h3 class="text-xl font-medium text-slate-300 mb-1">No Pitches Yet</h3>
                        <p>Be the first to submit a structured pitch to our network.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
