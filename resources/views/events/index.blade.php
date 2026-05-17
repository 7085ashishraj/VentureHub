<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-zinc-900 dark:text-white leading-tight">
            {{ __('Upcoming Events & Workshops') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 flex flex-col lg:flex-row gap-8">
        
        <!-- Events Grid -->
        <div class="w-full lg:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($events as $event)
                    <a href="{{ route('events.show', $event) }}" class="block">
                        <div class="bg-zinc-950 shadow-2xl rounded-3xl border border-zinc-800 overflow-hidden transition-all duration-300 hover:border-zinc-500 hover:shadow-[0_0_40px_-15px_rgba(255,255,255,0.1)] group h-full flex flex-col hover:-translate-y-1">
                            @if($event->image_path)
                                <div class="h-48 w-full overflow-hidden">
                                    <img src="{{ asset('storage/' . $event->image_path) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition duration-500" alt="{{ $event->title }}">
                                </div>
                            @else
                                <div class="bg-zinc-800 h-2 w-full"></div>
                            @endif
                            <div class="p-8 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-6">
                                    <h4 class="text-2xl font-black text-white group-hover:text-zinc-300 transition-colors pr-4">{{ $event->title }}</h4>
                                    <div class="bg-zinc-900 text-white px-4 py-2 rounded-2xl text-center border border-zinc-800 shrink-0 transform group-hover:scale-110 transition shrink-0">
                                        <span class="block text-xs uppercase font-bold tracking-widest text-zinc-500">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                                        <span class="block text-2xl font-black">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                    </div>
                                </div>
                                <p class="text-zinc-400 text-lg mb-8 line-clamp-3 leading-relaxed">{{ $event->description }}</p>
                                <div class="space-y-3 mt-auto bg-zinc-900 p-4 rounded-2xl border border-zinc-800">
                                    <div class="flex items-center text-sm font-semibold text-zinc-300">
                                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('l, h:i A') }}
                                    </div>
                                    <div class="flex items-center text-sm font-semibold text-zinc-300">
                                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $event->location ?: 'Online Webinar' }}
                                    </div>
                                    <div class="flex items-center text-sm font-semibold text-zinc-300">
                                        <svg class="w-5 h-5 mr-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Organized by <span class="text-white ml-1">{{ $event->organizer->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($events->isEmpty())
                 <div class="text-center py-16 bg-zinc-950 rounded-3xl border border-dashed border-zinc-800 shadow-xl">
                    <h3 class="mt-2 text-lg font-bold text-white">No Events Scheduled</h3>
                    <p class="mt-2 text-zinc-500">Host the first founders meet-up or webinar!</p>
                </div>
            @endif
        </div>

        <!-- Sidebar: Add Event Form -->
        <div class="w-full lg:w-1/4">
            <div class="bg-zinc-950 rounded-3xl shadow-2xl border border-zinc-800 p-6 sticky top-10">
                <h3 class="text-xl font-black text-white mb-6 flex items-center border-b border-zinc-800 pb-4">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Host an Event
                </h3>
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="relative group">
                        <label class="block text-xs uppercase tracking-widest font-bold mb-1 text-zinc-500 transition-colors group-focus-within:text-white">Event Title</label>
                        <input type="text" name="title" required class="w-full bg-transparent border border-zinc-600 rounded-xl text-white text-lg focus:ring-0 focus:border-white transition-colors px-4 py-3 placeholder-zinc-700" placeholder="e.g. Founder Meetup">
                    </div>
                    <div class="relative group">
                        <label class="block text-xs uppercase tracking-widest font-bold mb-1 text-zinc-500 transition-colors group-focus-within:text-white">Event Image</label>
                        <input type="file" name="image" accept="image/*" class="w-full text-sm text-zinc-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:uppercase file:tracking-widest file:font-bold file:bg-zinc-800 file:text-white hover:file:bg-zinc-700 transition file:cursor-pointer mt-2 cursor-pointer">
                    </div>
                    <div class="relative group">
                        <label class="block text-xs uppercase tracking-widest font-bold mb-1 text-zinc-500 transition-colors group-focus-within:text-white">Date & Time</label>
                        <input type="datetime-local" name="event_date" required class="w-full bg-transparent border border-zinc-600 rounded-xl text-white text-lg focus:ring-0 focus:border-white transition-colors px-4 py-3 placeholder-zinc-700 [color-scheme:dark]">
                    </div>
                    <div class="relative group">
                        <label class="block text-xs uppercase tracking-widest font-bold mb-1 text-zinc-500 transition-colors group-focus-within:text-white">Location (or Link)</label>
                        <input type="text" name="location" class="w-full bg-transparent border border-zinc-600 rounded-xl text-white text-lg focus:ring-0 focus:border-white transition-colors px-4 py-3 placeholder-zinc-700" placeholder="e.g. Zoom or New York">
                    </div>
                    <div class="relative group pb-2">
                        <label class="block text-xs uppercase tracking-widest font-bold mb-1 text-zinc-500 transition-colors group-focus-within:text-white">Details</label>
                        <textarea name="description" rows="3" required class="w-full bg-transparent border border-zinc-600 rounded-xl text-white text-lg focus:ring-0 focus:border-white transition-colors px-4 py-3 placeholder-zinc-700 resize-none" placeholder="What to expect..."></textarea>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="w-full block text-center bg-white text-black font-black uppercase tracking-widest py-4 px-4 border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                            Publish Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
