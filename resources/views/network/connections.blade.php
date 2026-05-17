<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-zinc-900 dark:text-white leading-tight flex items-center gap-3">
            <svg class="w-8 h-8 text-zinc-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            {{ __('My Connections') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/40 text-green-300 px-4 py-3 rounded-xl shadow-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pending Requests --}}
            @if($pendingRequests->count() > 0)
                <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-8 shadow-2xl">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                        <span class="bg-zinc-800 text-white text-xs font-bold px-2 py-1 rounded-full border border-zinc-700">{{ $pendingRequests->count() }}</span>
                        Pending Requests
                    </h2>
                    
                    <div class="space-y-4">
                        @foreach($pendingRequests as $request)
                            <div class="flex items-center justify-between p-4 bg-zinc-900 rounded-2xl border border-zinc-800">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-800 flex items-center justify-center font-bold text-white border border-zinc-700">
                                        @if($request->requester->profile_image)
                                            <img src="{{ asset('storage/' . $request->requester->profile_image) }}" class="w-full h-full object-cover grayscale">
                                        @else
                                            {{ substr($request->requester->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('network.show', $request->requester) }}" class="font-bold text-white hover:text-zinc-300 transition">{{ $request->requester->name }}</a>
                                        <p class="text-sm text-zinc-500">wants to connect</p>
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <form action="{{ route('connections.update', $request) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="accepted">
                                        <button type="submit" class="bg-white text-black px-4 py-2 border border-transparent font-bold text-sm transition-all shadow-[3px_3px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] hover:bg-zinc-200">Accept</button>
                                    </form>
                                    <form action="{{ route('connections.update', $request) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="bg-zinc-900 text-zinc-300 px-4 py-2 font-bold text-sm transition border border-zinc-700 shadow-[3px_3px_0px_0px_rgba(255,255,255,0.05)] hover:shadow-none hover:translate-x-[3px] hover:translate-y-[3px] hover:bg-zinc-800">Decline</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Active Connections --}}
            <div class="bg-zinc-950 rounded-3xl border border-zinc-800 p-8 shadow-2xl">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <span class="bg-zinc-800 text-white text-xs font-bold px-2 py-1 rounded-full border border-zinc-700">{{ $connections->count() }}</span>
                    Your Network
                </h2>
                
                @if($connections->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($connections as $connection)
                            @php
                                $partner = $connection->requester_id === auth()->id() ? $connection->recipient : $connection->requester;
                            @endphp
                            <div class="flex items-center justify-between p-4 bg-zinc-900 rounded-2xl border border-zinc-800 group">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-800 flex items-center justify-center font-bold text-white border border-zinc-700">
                                        @if($partner->profile_image)
                                            <img src="{{ asset('storage/' . $partner->profile_image) }}" class="w-full h-full object-cover grayscale">
                                        @else
                                            {{ substr($partner->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('network.show', $partner) }}" class="font-bold text-white hover:text-zinc-300 transition">{{ $partner->name }}</a>
                                        <p class="text-xs text-zinc-500">Connected</p>
                                    </div>
                                </div>
                                <div>
                                    <form action="{{ route('connections.destroy', $connection) }}" method="POST" onsubmit="return confirm('Remove this connection?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-zinc-600 hover:text-red-500 opacity-0 group-hover:opacity-100 transition p-2" title="Remove connection">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 border-2 border-dashed border-zinc-800 rounded-2xl">
                        <svg class="mx-auto h-12 w-12 text-zinc-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <h3 class="text-lg font-bold text-zinc-400">Your network is empty</h3>
                        <p class="mt-2 text-zinc-500 text-sm max-w-sm mx-auto">Start exploring the platform and send connection requests to build your startup network.</p>
                        <a href="{{ route('network.index') }}" class="mt-6 inline-block bg-white text-black font-black uppercase tracking-widest px-6 py-3 border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">Explore Network</a>
                    </div>
                @endif
            </div>

    </div>
</x-app-layout>
