<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-500 leading-tight">
            {{ __('Upcoming Events & Workshops') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 flex flex-col lg:flex-row gap-8">
        
        <!-- Events Grid -->
        <div class="w-full lg:w-3/4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($events as $event)
                    <div class="bg-gray-800/40 backdrop-blur-xl shadow-2xl rounded-3xl border border-gray-700/50 overflow-hidden transition-all duration-300 hover:shadow-emerald-500/10 hover:-translate-y-2 group">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2 w-full shadow-emerald-500"></div>
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-6">
                                <h4 class="text-2xl font-black text-gray-100 group-hover:text-emerald-400 transition-colors pr-4">{{ $event->title }}</h4>
                                <div class="bg-gray-900 text-emerald-400 px-4 py-2 rounded-2xl text-center shadow-inner border border-gray-700/50 shrink-0 transform group-hover:scale-110 transition shrink-0">
                                    <span class="block text-xs uppercase font-bold tracking-widest">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                                    <span class="block text-2xl font-black">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                                </div>
                            </div>
                            <p class="text-gray-400 text-lg mb-8 line-clamp-3 leading-relaxed">{{ $event->description }}</p>
                            <div class="space-y-3 mt-auto bg-gray-900/30 p-4 rounded-2xl border border-gray-700/30">
                                <div class="flex items-center text-sm font-semibold text-gray-300">
                                    <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('l, h:i A') }}
                                </div>
                                <div class="flex items-center text-sm font-semibold text-gray-300">
                                    <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $event->location ?: 'Online Webinar' }}
                                </div>
                                <div class="flex items-center text-sm font-semibold text-gray-300">
                                    <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Organized by <span class="text-emerald-400 ml-1">{{ $event->organizer->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($events->isEmpty())
                 <div class="text-center py-16 bg-gray-800/30 backdrop-blur-xl rounded-3xl border border-dashed border-gray-700/50">
                    <h3 class="mt-2 text-lg font-bold text-gray-300">No Events Scheduled</h3>
                    <p class="mt-2 text-gray-500">Host the first founders meet-up or webinar!</p>
                </div>
            @endif
        </div>

        <!-- Sidebar: Add Event Form -->
        <div class="w-full lg:w-1/4">
            <div class="bg-gray-900/60 backdrop-blur-2xl rounded-3xl shadow-2xl border border-gray-700/50 p-6 sticky top-28">
                <h3 class="text-xl font-black text-emerald-400 mb-6 flex items-center border-b border-gray-700 pb-4">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Host an Event
                </h3>
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-400 mb-2">Event Title</label>
                        <input type="text" name="title" required class="w-full rounded-xl border-gray-700 bg-gray-800/80 text-white focus:border-emerald-500 focus:ring-emerald-500 transition px-3 py-2.5">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-400 mb-2">Date & Time</label>
                        <input type="datetime-local" name="event_date" required class="w-full rounded-xl border-gray-700 bg-gray-800/80 text-white focus:border-emerald-500 focus:ring-emerald-500 transition px-3 py-2.5 [color-scheme:dark]">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-gray-400 mb-2">Location (or Link)</label>
                        <input type="text" name="location" class="w-full rounded-xl border-gray-700 bg-gray-800/80 text-white focus:border-emerald-500 focus:ring-emerald-500 transition px-3 py-2.5">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-400 mb-2">Details</label>
                        <textarea name="description" rows="3" required class="w-full rounded-xl border-gray-700 bg-gray-800/80 text-white focus:border-emerald-500 focus:ring-emerald-500 transition px-3 py-2.5"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-gray-900 font-extrabold py-3 px-4 rounded-xl shadow-lg shadow-emerald-500/30 transition transform hover:-translate-y-1">
                        Publish Event
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
