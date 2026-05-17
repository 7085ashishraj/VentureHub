<x-app-layout>
    <div class="min-h-screen bg-zinc-50 py-12 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto">

            {{-- Page Header --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 mb-14">
                <div>
                    <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.3em] mb-2">Deal Pipeline</p>
                    <h1 class="text-5xl font-black text-zinc-900 uppercase tracking-widest leading-none">
                        Deal Flow
                    </h1>
                    <div class="mt-3 w-16 h-1 bg-zinc-900"></div>
                    <p class="mt-4 text-zinc-500 font-bold text-sm uppercase tracking-widest">Structured pitches from verified entrepreneurs.</p>
                </div>
                <a href="{{ route('pitches.create') }}"
                   class="shrink-0 px-8 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(37,99,235,0.35)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                    + Submit Pitch
                </a>
            </div>

            {{-- Flash Message --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    class="mb-8 bg-blue-600 text-white px-6 py-4 rounded-xl border border-blue-500 flex items-center gap-3 font-black uppercase tracking-widest text-sm shadow-lg">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Pitch Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @forelse($pitches as $pitch)
                    <div class="bg-zinc-900 rounded-3xl border border-zinc-800 overflow-hidden shadow-2xl hover:-translate-y-1 hover:shadow-[0_20px_40px_rgba(0,0,0,0.18)] transition-all duration-300 group flex flex-col">

                        {{-- Card Top Bar --}}
                        <div class="h-1 w-full bg-zinc-800 group-hover:bg-blue-500 transition-colors duration-300"></div>

                        <div class="p-8 flex flex-col flex-grow">

                            {{-- Author Row --}}
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 rounded-full border-2 border-zinc-700 overflow-hidden bg-zinc-800 flex items-center justify-center font-black text-white text-lg shadow-lg">
                                    @if($pitch->user->profile_image)
                                        <img src="{{ asset('storage/' . $pitch->user->profile_image) }}" class="w-full h-full object-cover grayscale">
                                    @else
                                        {{ substr($pitch->user->name, 0, 1) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="font-black text-white flex items-center gap-2 text-sm">
                                        {{ $pitch->user->name }}
                                        @if($pitch->user->is_verified)
                                            <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                        @endif
                                    </div>
                                    <div class="text-[10px] text-zinc-500 font-black uppercase tracking-widest mt-0.5">{{ $pitch->created_at->diffForHumans() }}</div>
                                </div>
                            </div>

                            {{-- Title --}}
                            <h2 class="text-2xl font-black text-white mb-6 uppercase tracking-wide leading-tight">{{ $pitch->title }}</h2>

                            {{-- Problem / Solution Blocks --}}
                            <div class="space-y-4 mb-8 flex-grow">
                                <div class="bg-zinc-800 p-5 rounded-2xl border border-zinc-700">
                                    <h3 class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Problem</h3>
                                    <p class="text-sm font-bold text-white line-clamp-2 leading-relaxed">{{ $pitch->problem }}</p>
                                </div>
                                <div class="bg-zinc-800 p-5 rounded-2xl border border-zinc-700">
                                    <h3 class="text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Solution</h3>
                                    <p class="text-sm font-bold text-white line-clamp-2 leading-relaxed">{{ $pitch->solution }}</p>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="flex justify-between items-center pt-6 border-t border-zinc-700">
                                <div>
                                    <p class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-1">The Ask</p>
                                    <p class="text-white font-black text-sm">{{ $pitch->ask ?? 'Contact for details' }}</p>
                                </div>
                                <a href="{{ route('pitches.show', $pitch) }}"
                                   class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest text-[10px] border border-transparent transition-all shadow-[4px_4px_0px_0px_rgba(37,99,235,0.4)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                                    View Details →
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center border-2 border-dashed border-zinc-300 rounded-3xl bg-white shadow-sm">
                        <svg class="mx-auto h-16 w-16 text-zinc-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <h3 class="text-2xl font-black text-zinc-900 mb-3 uppercase tracking-widest">No Pitches Yet</h3>
                        <p class="text-zinc-400 font-bold uppercase tracking-widest text-sm mb-8">Be the first to submit a structured pitch to our network.</p>
                        <a href="{{ route('pitches.create') }}" class="inline-block px-8 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest transition-all shadow-[6px_6px_0px_0px_rgba(37,99,235,0.35)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                            Submit Your Pitch
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
