<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-zinc-900 dark:text-white leading-tight uppercase tracking-widest">
            {{ __('Venture Rooms') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10 space-y-8">
        
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-black text-black dark:text-white tracking-widest uppercase border-l-4 border-black dark:border-white pl-4">
                Active Workspaces
            </h1>
            <a href="{{ route('venture-rooms.create') }}" class="px-8 py-3 rounded-xl bg-violet-700 hover:bg-violet-800 dark:bg-white dark:hover:bg-zinc-200 text-white dark:text-black font-black uppercase tracking-widest border border-transparent transition-all shadow-[4px_4px_0px_0px_rgba(0,0,0,0.3)] dark:shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                + Create Room
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <a href="{{ route('venture-rooms.show', $room) }}" class="block group relative">
                    <div class="rounded-3xl bg-zinc-950 border border-zinc-800 p-8 shadow-2xl transition-all duration-300 relative overflow-hidden h-full flex flex-col group-hover:-translate-y-2 group-hover:border-zinc-500">
                        
                        <div class="absolute top-0 left-0 w-full h-1 bg-zinc-800 group-hover:bg-white transition-colors duration-300"></div>
                        
                        <div class="flex justify-between items-start mb-6 mt-2">
                            <div class="bg-zinc-900 text-white text-[10px] font-black px-4 py-1.5 rounded-full border border-zinc-700 uppercase tracking-widest">
                                {{ $room->ventureStage->name ?? 'Ideation' }}
                            </div>
                            <div class="text-zinc-500 font-bold text-xs uppercase tracking-widest">
                                {{ $room->members()->count() }} Members
                            </div>
                        </div>

                        <h3 class="text-3xl font-black text-white mb-3">{{ $room->name }}</h3>
                        <p class="text-zinc-400 text-sm flex-grow leading-relaxed font-bold mb-8">
                            {{ $room->description ?? 'A new venture taking shape.' }}
                        </p>

                        <div class="flex items-center gap-4 mt-auto pt-6 border-t border-zinc-800">
                            <div class="w-10 h-10 rounded-full bg-zinc-900 flex items-center justify-center text-sm font-black text-white overflow-hidden border border-zinc-700 shadow-lg">
                                @if($room->creator->profile_image)
                                    <img src="{{ asset('storage/' . $room->creator->profile_image) }}" class="w-full h-full object-cover grayscale">
                                @else
                                    {{ substr($room->creator->name, 0, 1) }}
                                @endif
                            </div>
                            <div class="text-sm font-bold text-white">
                                <span class="text-zinc-500 uppercase text-[10px] tracking-widest block mb-0.5">Admin</span>
                                {{ $room->creator->name }}
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-20 text-center border-2 border-dashed border-zinc-800 rounded-3xl text-zinc-500 bg-zinc-950 shadow-2xl">
                    <svg class="mx-auto h-16 w-16 text-zinc-700 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <h3 class="text-2xl font-black text-white mb-2 uppercase tracking-widest">No Venture Rooms</h3>
                    <p class="text-zinc-500 font-bold uppercase tracking-widest text-sm">Get started by creating a new collaborative space.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
