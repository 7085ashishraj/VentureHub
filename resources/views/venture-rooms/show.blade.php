<x-app-layout>
    <div class="min-h-screen bg-slate-900 text-slate-200 py-8 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto space-y-8">
            
            {{-- Room Header --}}
            <div class="bg-slate-800/50 backdrop-blur-md rounded-3xl p-8 border border-slate-700/50 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-transparent"></div>
                <div class="relative">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="bg-indigo-500/20 text-indigo-400 text-xs font-bold px-3 py-1 rounded-full border border-indigo-500/30 uppercase tracking-wider">
                            {{ $venture_room->ventureStage->name ?? 'Stage Not Set' }}
                        </span>
                        @if($venture_room->project)
                            <a href="{{ route('projects.show', $venture_room->project) }}" class="text-xs text-slate-400 hover:text-indigo-400 transition flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                Linked Project
                            </a>
                        @endif
                    </div>
                    <h1 class="text-4xl font-black text-white">{{ $venture_room->name }}</h1>
                    <p class="text-slate-400 mt-2 max-w-2xl">{{ $venture_room->description }}</p>
                </div>
                
                <div class="relative flex -space-x-4">
                    @foreach($venture_room->members->take(5) as $member)
                        <div class="w-12 h-12 rounded-full border-2 border-slate-800 bg-slate-700 flex items-center justify-center text-sm font-bold text-white overflow-hidden shadow-lg z-10 hover:z-20 transform hover:scale-110 transition-all cursor-pointer" title="{{ $member->user->name }} ({{ $member->role }})">
                            @if($member->user->profile_image)
                                <img src="{{ asset('storage/' . $member->user->profile_image) }}" class="w-full h-full object-cover">
                            @else
                                {{ substr($member->user->name, 0, 1) }}
                            @endif
                        </div>
                    @endforeach
                    @if($venture_room->members->count() > 5)
                        <div class="w-12 h-12 rounded-full border-2 border-slate-800 bg-slate-800 flex items-center justify-center text-xs font-bold text-slate-400 z-0">
                            +{{ $venture_room->members->count() - 5 }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Lean Canvas Widget --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-slate-800/40 backdrop-blur-md rounded-3xl border border-slate-700 p-6 shadow-xl">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg>
                                Lean Canvas
                            </h2>
                            <button class="text-sm text-indigo-400 hover:text-indigo-300 font-medium bg-indigo-500/10 px-4 py-1.5 rounded-full transition">Expand</button>
                        </div>

                        <form action="{{ route('lean-canvases.update', $venture_room->leanCanvas) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-400">Problem</label>
                                    <textarea name="problem" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl p-3 text-sm text-slate-200 focus:ring-purple-500 focus:border-purple-500 h-24">{{ $venture_room->leanCanvas->problem }}</textarea>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-semibold text-slate-400">Solution</label>
                                    <textarea name="solution" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl p-3 text-sm text-slate-200 focus:ring-purple-500 focus:border-purple-500 h-24">{{ $venture_room->leanCanvas->solution }}</textarea>
                                </div>
                                <div class="space-y-2 md:col-span-2">
                                    <label class="text-sm font-semibold text-slate-400">Unique Value Proposition</label>
                                    <textarea name="value_proposition" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl p-3 text-sm text-slate-200 focus:ring-purple-500 focus:border-purple-500 h-24">{{ $venture_room->leanCanvas->value_proposition }}</textarea>
                                </div>
                            </div>
                            <div class="mt-4 flex justify-end">
                                <button type="submit" class="px-5 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg text-sm font-semibold transition">Save Canvas</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Side Widgets (Milestones & Sweat Equity) --}}
                <div class="lg:col-span-1 space-y-6">
                    
                    {{-- Milestone Tracker Widget --}}
                    <div class="bg-slate-800/40 backdrop-blur-md rounded-3xl border border-slate-700 p-6 shadow-xl flex flex-col max-h-[500px]">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Milestones
                            </h2>
                        </div>

                        <div class="flex-grow space-y-3 overflow-y-auto pr-2 custom-scrollbar">
                            @forelse($venture_room->milestones as $milestone)
                                <div class="p-3 rounded-xl bg-slate-900/60 border {{ $milestone->status === 'completed' ? 'border-green-500/30' : 'border-slate-700' }} group transition">
                                    <div class="flex justify-between items-start">
                                        <h4 class="text-sm font-semibold text-white {{ $milestone->status === 'completed' ? 'line-through text-slate-400' : '' }}">{{ $milestone->title }}</h4>
                                        <form action="{{ route('milestones.update', $milestone) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="{{ $milestone->status === 'completed' ? 'pending' : 'completed' }}">
                                            <button type="submit" class="text-slate-500 hover:text-green-400 transition">
                                                <svg class="w-4 h-4 {{ $milestone->status === 'completed' ? 'text-green-400' : '' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-slate-500 text-sm">No milestones set.</div>
                            @endforelse
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-700">
                            <form action="{{ route('milestones.store', $venture_room) }}" method="POST" class="flex gap-2">
                                @csrf
                                <input type="hidden" name="status" value="pending">
                                <input type="text" name="title" placeholder="New milestone..." required class="flex-grow bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-sm text-white focus:ring-green-500 focus:border-green-500">
                                <button type="submit" class="bg-green-600 hover:bg-green-500 text-white rounded-lg px-3 py-1.5 font-bold transition">+</button>
                            </form>
                        </div>
                    </div>

                    {{-- Sweat Equity Exchange --}}
                    <div class="bg-slate-800/40 backdrop-blur-md rounded-3xl border border-slate-700 p-6 shadow-xl flex flex-col max-h-[500px] relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-yellow-500/10 rounded-bl-full"></div>
                        <div class="flex justify-between items-center mb-6 relative">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Sweat Equity
                            </h2>
                        </div>

                        <div class="flex-grow space-y-3 overflow-y-auto pr-2 custom-scrollbar relative">
                            @forelse($venture_room->sweatEquityTasks as $task)
                                <div class="p-3 rounded-xl bg-slate-900/60 border border-slate-700">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="text-sm font-semibold text-white">{{ $task->title }}</h4>
                                        <span class="text-xs font-bold bg-yellow-500/20 text-yellow-400 px-2 py-0.5 rounded border border-yellow-500/30">{{ $task->credits_offered }} CR</span>
                                    </div>
                                    <p class="text-xs text-slate-400 mb-2 line-clamp-2">{{ $task->description }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="text-[10px] uppercase font-bold {{ $task->status === 'open' ? 'text-green-400' : 'text-slate-500' }}">{{ $task->status }}</span>
                                        @if($task->status === 'open')
                                            <form action="{{ route('sweat-equity.claim', $task) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-xs bg-slate-700 hover:bg-slate-600 text-white px-2 py-1 rounded transition">Claim</button>
                                            </form>
                                        @elseif($task->status === 'assigned' && $task->assigned_to === auth()->id())
                                            <form action="{{ route('sweat-equity.complete', $task) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-xs bg-green-600 hover:bg-green-500 text-white px-2 py-1 rounded transition">Complete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4 text-slate-500 text-sm">No tasks available.</div>
                            @endforelse
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-700 relative">
                            <form action="{{ route('sweat-equity.store', $venture_room) }}" method="POST" class="space-y-2">
                                @csrf
                                <input type="text" name="title" placeholder="Task title..." required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-sm text-white focus:ring-yellow-500 focus:border-yellow-500">
                                <textarea name="description" placeholder="Description..." required class="w-full bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-xs text-white focus:ring-yellow-500 focus:border-yellow-500" rows="2"></textarea>
                                <div class="flex gap-2">
                                    <input type="number" name="credits_offered" placeholder="Credits" required class="w-20 bg-slate-900 border border-slate-700 rounded-lg px-3 py-1.5 text-sm text-white focus:ring-yellow-500 focus:border-yellow-500">
                                    <button type="submit" class="flex-grow bg-slate-700 hover:bg-slate-600 text-white rounded-lg px-3 py-1.5 font-bold transition text-sm">Post Task</button>
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
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</x-app-layout>
