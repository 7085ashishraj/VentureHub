<x-app-layout>
    <div class="min-h-screen bg-slate-900 text-slate-200 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">
                    Venture Rooms
                </h1>
                <a href="{{ route('venture-rooms.create') }}" class="px-6 py-2.5 rounded-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold shadow-[0_0_15px_rgba(79,70,229,0.5)] transition-all">
                    + Create Room
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($rooms as $room)
                    <a href="{{ route('venture-rooms.show', $room) }}" class="block group">
                        <div class="rounded-3xl bg-slate-800/40 backdrop-blur-md border border-slate-700/50 p-6 shadow-xl hover:bg-slate-800/60 hover:border-indigo-500/50 transition-all duration-300 relative overflow-hidden h-full flex flex-col">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-bl-full group-hover:scale-110 transition-transform"></div>
                            
                            <div class="flex justify-between items-start mb-4">
                                <div class="bg-indigo-500/20 text-indigo-300 text-xs font-bold px-3 py-1 rounded-full border border-indigo-500/20">
                                    {{ $room->ventureStage->name ?? 'Ideation' }}
                                </div>
                                <div class="text-slate-500 text-sm">
                                    {{ $room->members()->count() }} Members
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-white mb-2">{{ $room->name }}</h3>
                            <p class="text-slate-400 text-sm flex-grow line-clamp-3 mb-6">
                                {{ $room->description ?? 'A new venture taking shape.' }}
                            </p>

                            <div class="flex items-center gap-3 mt-auto pt-4 border-t border-slate-700/50">
                                <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold text-white overflow-hidden">
                                    @if($room->creator->profile_image)
                                        <img src="{{ asset('storage/' . $room->creator->profile_image) }}" class="w-full h-full object-cover">
                                    @else
                                        {{ substr($room->creator->name, 0, 1) }}
                                    @endif
                                </div>
                                <div class="text-sm text-slate-300">
                                    <span class="text-slate-500">Created by</span> {{ $room->creator->name }}
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full py-16 text-center border-2 border-dashed border-slate-700 rounded-3xl text-slate-500">
                        <svg class="mx-auto h-12 w-12 text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <h3 class="text-xl font-medium text-slate-300 mb-1">No Venture Rooms</h3>
                        <p>Get started by creating a new collaborative space.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
