<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-zinc-900 dark:text-white leading-tight">
            {{ __('Entrepreneurs Directory') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($users as $user)
                <a href="{{ route('network.show', $user) }}" class="block group relative">
                    <div class="relative bg-zinc-950 rounded-3xl border border-zinc-800 p-8 flex flex-col items-center text-center transition-all duration-300 group-hover:-translate-y-1 group-hover:border-zinc-500 group-hover:shadow-[0_0_40px_-15px_rgba(255,255,255,0.1)] h-full overflow-hidden shadow-2xl">
                        
                        <div class="h-28 w-28 rounded-full bg-zinc-900 flex items-center justify-center text-white font-black text-4xl shadow-xl mb-6 overflow-hidden border border-zinc-800 group-hover:border-zinc-500 transition">
                            @if($user->profile_image)
                                <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="object-cover h-full w-full grayscale group-hover:grayscale-0 transition duration-500">
                            @else
                                {{ substr($user->name, 0, 1) }}
                            @endif
                        </div>

                        <h3 class="text-2xl font-black text-white mb-2 group-hover:text-zinc-300 transition">{{ $user->name }}</h3>
                        
                        @if($user->skills->count() > 0)
                            <p class="text-sm font-bold text-zinc-300 mb-4 bg-zinc-900 px-4 py-1.5 rounded-full border border-zinc-800 truncate w-full" title="{{ $user->skills->pluck('name')->implode(', ') }}">{{ Str::limit($user->skills->pluck('name')->implode(', '), 30) }}</p>
                        @endif

                        <p class="text-sm text-zinc-400 line-clamp-3 mt-auto leading-relaxed">{{ $user->bio ?? 'Silent builder.' }}</p>

                        <div class="mt-6 pt-5 border-t border-zinc-800 w-full flex justify-center divide-x divide-zinc-800 text-zinc-500 font-semibold text-sm">
                            @if($user->linkedin)
                                <span class="px-4 hover:text-white transition">LinkedIn</span>
                            @endif
                            @if($user->github)
                                <span class="px-4 hover:text-white transition">GitHub</span>
                            @endif
                            @if(!$user->linkedin && !$user->github)
                                <span class="px-4 text-white hover:text-zinc-300 transition underline decoration-zinc-600 underline-offset-4">View Profile</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</x-app-layout>
