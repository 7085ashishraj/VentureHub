<x-app-layout>
    <div class="min-h-screen bg-zinc-100 dark:bg-zinc-950 text-zinc-200 py-10 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto space-y-10">
            
            {{-- Room Header --}}
            <div class="bg-zinc-950 rounded-3xl p-10 border border-zinc-800 flex flex-col md:flex-row items-start md:items-center justify-between gap-8 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-zinc-800 rounded-bl-full group-hover:scale-110 transition-transform opacity-30"></div>
                
                <div class="relative z-10">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="bg-zinc-900 text-white text-[10px] font-black px-4 py-1.5 rounded-full border border-zinc-700 uppercase tracking-widest">
                            {{ $venture_room->ventureStage->name ?? 'Stage Not Set' }}
                        </span>
                        @if($venture_room->project)
                            <a href="{{ route('projects.show', $venture_room->project) }}" class="text-[10px] font-black text-zinc-400 hover:text-white transition flex items-center gap-1 uppercase tracking-widest">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                Linked Project
                            </a>
                        @endif
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-black text-white uppercase tracking-widest mb-3">{{ $venture_room->name }}</h1>
                    <p class="text-zinc-400 font-bold max-w-2xl text-lg">{{ $venture_room->description }}</p>
                </div>
                
                <div class="relative flex -space-x-4 z-10">
                    @foreach($venture_room->members->take(5) as $member)
                        <div class="w-14 h-14 rounded-full border-4 border-zinc-950 bg-zinc-800 flex items-center justify-center text-sm font-black text-white overflow-hidden shadow-lg hover:z-20 transform hover:scale-110 transition-all cursor-pointer" title="{{ $member->user->name }} ({{ $member->role }})">
                            @if($member->user->profile_image)
                                <img src="{{ asset('storage/' . $member->user->profile_image) }}" class="w-full h-full object-cover grayscale">
                            @else
                                {{ substr($member->user->name, 0, 1) }}
                            @endif
                        </div>
                    @endforeach
                    @if($venture_room->members->count() > 5)
                        <div class="w-14 h-14 rounded-full border-4 border-zinc-950 bg-zinc-900 flex items-center justify-center text-xs font-black text-white z-0 border border-zinc-700 shadow-lg">
                            +{{ $venture_room->members->count() - 5 }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Flash Message --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    class="bg-white text-black px-6 py-4 rounded-xl shadow-2xl border border-zinc-200 flex items-center gap-3 transform transition-all duration-500 z-50">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-black uppercase tracking-widest text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                {{-- Lean Canvas Widget --}}
                <div class="lg:col-span-2 space-y-8" x-data="{ expandedCanvas: false }">
                    <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-8 sm:p-10 shadow-2xl transition-all duration-500">
                        <div class="flex justify-between items-center mb-8 border-b border-zinc-800 pb-6">
                            <h2 class="text-2xl font-black text-white flex items-center gap-3 uppercase tracking-widest">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
                                Lean Canvas
                            </h2>
                            <button @click="expandedCanvas = !expandedCanvas" type="button" class="text-[10px] text-white font-black bg-zinc-900 px-4 py-2 rounded-full border border-zinc-700 uppercase tracking-widest hover:bg-white hover:text-black transition-colors focus:outline-none" x-text="expandedCanvas ? 'Collapse' : 'Expand'"></button>
                        </div>

                        <form action="{{ route('lean-canvases.update', $venture_room->leanCanvas) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Problem</label>
                                    <textarea name="problem" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-32 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->problem }}</textarea>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Solution</label>
                                    <textarea name="solution" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-32 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->solution }}</textarea>
                                </div>
                                <div class="space-y-3 md:col-span-2">
                                    <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Unique Value Proposition</label>
                                    <textarea name="value_proposition" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-24 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->value_proposition }}</textarea>
                                </div>
                            </div>
                            
                            {{-- Expanded Fields --}}
                            <div x-show="expandedCanvas" x-collapse x-cloak class="mt-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-zinc-800 pt-6">
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Key Metrics</label>
                                        <textarea name="key_metrics" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-24 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->key_metrics }}</textarea>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Unfair Advantage</label>
                                        <textarea name="unfair_advantage" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-24 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->unfair_advantage }}</textarea>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Channels</label>
                                        <textarea name="channels" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-24 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->channels }}</textarea>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Customer Segments</label>
                                        <textarea name="customer_segments" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-24 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->customer_segments }}</textarea>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Cost Structure</label>
                                        <textarea name="cost_structure" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-24 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->cost_structure }}</textarea>
                                    </div>
                                    <div class="space-y-3">
                                        <label class="text-[10px] font-black text-zinc-400 uppercase tracking-widest">Revenue Streams</label>
                                        <textarea name="revenue_streams" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl p-4 text-sm font-bold text-white focus:ring-white focus:border-white h-24 resize-none transition-all placeholder-zinc-700">{{ $venture_room->leanCanvas->revenue_streams }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end">
                                <button type="submit" class="px-8 py-3.5 rounded-xl bg-white text-black font-black uppercase tracking-widest border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                                    Save Canvas
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Side Widgets (Milestones & Sweat Equity) --}}
                <div class="lg:col-span-1 space-y-10">
                    
                    {{-- Milestone Tracker Widget --}}
                    <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-8 shadow-2xl flex flex-col max-h-[500px]">
                        <div class="flex justify-between items-center mb-6 border-b border-zinc-800 pb-4">
                            <h2 class="text-xl font-black text-white flex items-center gap-2 uppercase tracking-widest">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Milestones
                            </h2>
                        </div>

                        <div class="flex-grow space-y-4 overflow-y-auto pr-2 custom-scrollbar">
                            @forelse($venture_room->milestones as $milestone)
                                <div class="p-4 rounded-xl bg-zinc-900 border {{ $milestone->status === 'completed' ? 'border-zinc-700 opacity-50' : 'border-zinc-800' }} group transition">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-sm font-bold text-white {{ $milestone->status === 'completed' ? 'line-through text-zinc-500' : '' }}">{{ $milestone->title }}</h4>
                                        <form action="{{ route('milestones.update', $milestone) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="{{ $milestone->status === 'completed' ? 'pending' : 'completed' }}">
                                            <button type="submit" class="text-zinc-500 hover:text-white transition">
                                                <svg class="w-5 h-5 {{ $milestone->status === 'completed' ? 'text-white' : '' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-zinc-500 text-[10px] font-black uppercase tracking-widest">No milestones set.</div>
                            @endforelse
                        </div>

                        <div class="mt-6 pt-6 border-t border-zinc-800">
                            <form action="{{ route('milestones.store', $venture_room) }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="hidden" name="status" value="pending">
                                <input type="text" name="title" placeholder="New milestone..." required class="flex-grow bg-zinc-900 border border-zinc-800 rounded-lg px-4 py-3 text-sm font-bold text-white focus:ring-white focus:border-white transition-all placeholder-zinc-700">
                                <button type="submit" class="bg-white hover:bg-zinc-200 text-black rounded-lg px-4 py-3 font-black transition text-lg leading-none">+</button>
                            </form>
                        </div>
                    </div>

                    {{-- Sweat Equity Exchange --}}
                    <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-8 shadow-2xl flex flex-col max-h-[500px]">
                        <div class="flex justify-between items-center mb-6 border-b border-zinc-800 pb-4">
                            <h2 class="text-xl font-black text-white flex items-center gap-2 uppercase tracking-widest">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Sweat Equity
                            </h2>
                        </div>

                        <div class="flex-grow space-y-4 overflow-y-auto pr-2 custom-scrollbar">
                            @forelse($venture_room->sweatEquityTasks as $task)
                                <div class="p-4 rounded-xl bg-zinc-900 border border-zinc-800">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-sm font-bold text-white">{{ $task->title }}</h4>
                                        <span class="text-[10px] font-black bg-white text-black px-2 py-1 rounded-sm uppercase tracking-widest shadow-sm">{{ $task->credits_offered }} CR</span>
                                    </div>
                                    <p class="text-xs text-zinc-400 font-medium mb-4 line-clamp-2">{{ $task->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-[10px] uppercase font-black tracking-widest {{ $task->status === 'open' ? 'text-white' : 'text-zinc-500' }}">{{ $task->status }}</span>
                                        @if($task->status === 'open')
                                            <form action="{{ route('sweat-equity.claim', $task) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-[10px] font-black uppercase tracking-widest bg-zinc-800 hover:bg-white hover:text-black text-white px-3 py-1.5 rounded transition border border-zinc-700">Claim</button>
                                            </form>
                                        @elseif($task->status === 'assigned' && $task->assigned_to === auth()->id())
                                            <form action="{{ route('sweat-equity.complete', $task) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-[10px] font-black uppercase tracking-widest bg-white hover:bg-zinc-200 text-black px-3 py-1.5 rounded transition shadow-sm">Complete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-zinc-500 text-[10px] font-black uppercase tracking-widest">No tasks available.</div>
                            @endforelse
                        </div>

                        <div class="mt-6 pt-6 border-t border-zinc-800">
                            <form action="{{ route('sweat-equity.store', $venture_room) }}" method="POST" class="space-y-3">
                                @csrf
                                <input type="text" name="title" placeholder="Task title..." required class="w-full bg-zinc-900 border border-zinc-800 rounded-lg px-4 py-2.5 text-sm font-bold text-white focus:ring-white focus:border-white transition-all placeholder-zinc-700">
                                <textarea name="description" placeholder="Description..." required class="w-full bg-zinc-900 border border-zinc-800 rounded-lg px-4 py-2.5 text-xs font-bold text-white focus:ring-white focus:border-white transition-all placeholder-zinc-700 resize-none" rows="2"></textarea>
                                <div class="flex gap-2">
                                    <input type="number" name="credits_offered" placeholder="Credits" required class="w-24 bg-zinc-900 border border-zinc-800 rounded-lg px-4 py-2.5 text-sm font-bold text-white focus:ring-white focus:border-white transition-all placeholder-zinc-700">
                                    <button type="submit" class="flex-grow bg-white hover:bg-zinc-200 text-black rounded-lg px-4 py-2.5 font-black uppercase tracking-widest transition text-xs shadow-sm">Post Task</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #52525b; }
    </style>
</x-app-layout>
