<x-app-layout>
    <div class="min-h-screen bg-zinc-100 dark:bg-zinc-950 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-5xl mx-auto space-y-8">
            
            <a href="{{ route('events.index') }}" class="inline-flex items-center text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition font-bold text-sm uppercase tracking-widest">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Events
            </a>

            @if(session('success'))
                <div class="bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Event Header Image --}}
            <div class="w-full h-64 md:h-96 rounded-3xl overflow-hidden relative shadow-2xl border border-zinc-800">
                @if($event->image_path)
                    <img src="{{ asset('storage/' . $event->image_path) }}" class="w-full h-full object-cover grayscale" alt="{{ $event->title }}">
                @else
                    <div class="w-full h-full bg-zinc-900 flex items-center justify-center opacity-80">
                        <svg class="w-32 h-32 text-zinc-800" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 22h20L12 2zm0 4.5l6.5 13H5.5L12 6.5z"/></svg>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-zinc-950/60 to-transparent"></div>
                
                <div class="absolute bottom-0 left-0 p-8 sm:p-12 w-full flex flex-col sm:flex-row justify-between items-end gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="bg-white text-black font-bold px-3 py-1 rounded-full text-sm">
                                {{ \Carbon\Carbon::parse($event->event_date)->format('M d, Y') }}
                            </span>
                            <span class="bg-zinc-900 backdrop-blur text-white font-semibold px-3 py-1 rounded-full text-sm border border-zinc-700">
                                {{ \Carbon\Carbon::parse($event->event_date)->format('h:i A') }}
                            </span>
                        </div>
                        <h1 class="text-4xl sm:text-5xl font-black text-white mb-2 leading-tight">
                            {{ $event->title }}
                        </h1>
                        <p class="text-zinc-300 text-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $event->location ?: 'Online Webinar' }}
                        </p>
                    </div>
                    
                    {{-- User Action Buttons (Not Creator) --}}
                    @if(auth()->check() && auth()->id() !== $event->user_id)
                        <div class="flex items-center gap-3 bg-zinc-900/80 backdrop-blur-xl p-3 rounded-2xl border border-zinc-800">
                            @if($userTicket && $userTicket->status === 'purchased')
                                <div class="px-6 py-3 rounded-xl bg-zinc-800 text-white font-bold border border-zinc-700 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Ticket Secured
                                </div>
                            @else
                                <form action="{{ route('events.ticket', $event) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="interested">
                                    <button type="submit" class="px-6 py-3 rounded-xl font-bold transition {{ $userTicket && $userTicket->status === 'interested' ? 'bg-zinc-800 text-white border border-zinc-700' : 'bg-zinc-900 text-zinc-400 border border-zinc-800 hover:bg-zinc-800 hover:text-white' }}">
                                        {{ $userTicket && $userTicket->status === 'interested' ? 'Interested ✓' : 'Interested' }}
                                    </button>
                                </form>
                                <form action="{{ route('events.ticket', $event) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="purchased">
                                    <button type="submit" class="px-6 py-3 rounded-xl bg-white hover:bg-zinc-200 text-black font-black transition transform hover:-translate-y-1">
                                        Buy Ticket
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Main Details --}}
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 shadow-xl">
                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            About this Event
                        </h2>
                        <div class="text-zinc-300 leading-relaxed space-y-4 text-lg">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-8">
                    {{-- Organizer --}}
                    <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 shadow-xl">
                        <h2 class="text-sm font-bold text-zinc-500 uppercase tracking-widest mb-4">Hosted By</h2>
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-full overflow-hidden bg-zinc-800 border-2 border-zinc-700">
                                @if($event->organizer->profile_image)
                                    <img src="{{ asset('storage/' . $event->organizer->profile_image) }}" class="w-full h-full object-cover grayscale">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-zinc-900 text-white font-bold text-xl">
                                        {{ substr($event->organizer->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('network.show', $event->organizer) }}" class="font-bold text-white text-lg hover:text-zinc-300 transition block">{{ $event->organizer->name }}</a>
                                <span class="text-sm text-zinc-400">{{ $event->organizer->profile?->role ?? 'Event Organizer' }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Creator Dashboard (Only visible to creator) --}}
                    @if(auth()->check() && auth()->id() === $event->user_id)
                        <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 shadow-xl">
                            <h2 class="text-xl font-black text-white mb-6 flex items-center gap-2">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                Event Dashboard
                            </h2>
                            
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-zinc-900 p-4 rounded-2xl border border-zinc-800 text-center">
                                    <div class="text-3xl font-black text-white">{{ $purchasedCount }}</div>
                                    <div class="text-xs text-zinc-500 font-bold uppercase mt-1">Tickets Sold</div>
                                </div>
                                <div class="bg-zinc-900 p-4 rounded-2xl border border-zinc-800 text-center">
                                    <div class="text-3xl font-black text-white">{{ $interestedCount }}</div>
                                    <div class="text-xs text-zinc-500 font-bold uppercase mt-1">Interested</div>
                                </div>
                            </div>

                            @if($event->tickets->count() > 0)
                                <h3 class="text-sm font-bold text-zinc-400 mb-3 border-b border-zinc-800 pb-2">Recent Activity</h3>
                                <div class="space-y-3 max-h-64 overflow-y-auto pr-2">
                                    @foreach($event->tickets->sortByDesc('updated_at') as $ticket)
                                        <div class="flex items-center justify-between p-2 rounded-xl hover:bg-zinc-800 transition">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center text-xs font-bold text-white border border-zinc-700">
                                                    {{ substr($ticket->user->name, 0, 1) }}
                                                </div>
                                                <a href="{{ route('network.show', $ticket->user) }}" class="text-sm font-bold text-zinc-200 hover:text-white">{{ $ticket->user->name }}</a>
                                            </div>
                                            @if($ticket->status === 'purchased')
                                                <span class="text-xs font-bold bg-white text-black px-2 py-1 rounded-full">Bought</span>
                                            @else
                                                <span class="text-xs font-bold bg-zinc-800 text-zinc-300 px-2 py-1 rounded-full border border-zinc-700">Interested</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
