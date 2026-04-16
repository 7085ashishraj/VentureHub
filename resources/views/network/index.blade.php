<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-pink-500 leading-tight">
            {{ __('Entrepreneurs Directory') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($users as $user)
                <a href="{{ route('network.show', $user) }}" class="block group relative">
                    <!-- Glow effect -->
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-orange-500 to-pink-500 rounded-[2rem] blur opacity-0 group-hover:opacity-30 transition duration-500"></div>
                    
                    <div class="relative bg-gray-900/60 backdrop-blur-xl rounded-[2rem] border border-gray-700/50 p-8 flex flex-col items-center text-center transition duration-500 group-hover:-translate-y-2 group-hover:bg-gray-800/80 h-full">
                        
                        <div class="h-28 w-28 rounded-full bg-gradient-to-br from-orange-400 to-pink-500 flex items-center justify-center text-white font-black text-4xl shadow-2xl mb-6 overflow-hidden ring-4 ring-gray-800 group-hover:ring-orange-500/50 transition">
                            @if($user->profile_image)
                                <img src="{{ $user->profile_image }}" alt="{{ $user->name }}" class="object-cover h-full w-full">
                            @else
                                {{ substr($user->name, 0, 1) }}
                            @endif
                        </div>

                        <h3 class="text-2xl font-black text-gray-100 mb-2 group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-orange-400 group-hover:to-pink-500 transition">{{ $user->name }}</h3>
                        
                        @if($user->skills)
                            <p class="text-sm font-bold text-orange-400/90 mb-4 bg-orange-500/10 px-4 py-1.5 rounded-full border border-orange-500/20 truncate w-full">{{ Str::limit($user->skills, 25) }}</p>
                        @endif

                        <p class="text-sm text-gray-400 line-clamp-3 mt-auto leading-relaxed">{{ $user->bio ?? 'Silent builder.' }}</p>

                        <div class="mt-6 pt-5 border-t border-gray-700/50 w-full flex justify-center divide-x divide-gray-700 text-gray-400 font-semibold text-sm">
                            @if($user->linkedin)
                                <span class="px-4 hover:text-blue-400 transition">LinkedIn</span>
                            @endif
                            @if($user->github)
                                <span class="px-4 hover:text-white transition">GitHub</span>
                            @endif
                            @if(!$user->linkedin && !$user->github)
                                <span class="px-4 text-gray-600">View Profile</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</x-app-layout>
