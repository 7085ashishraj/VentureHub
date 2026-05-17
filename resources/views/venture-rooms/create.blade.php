<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-zinc-900 dark:text-white leading-tight uppercase tracking-widest">
            {{ __('Initialize Workspace') }}
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 flex items-center justify-center min-h-[calc(100vh-140px)] py-6">
        
        <div class="w-full flex rounded-3xl bg-zinc-950 border border-zinc-800 shadow-2xl overflow-hidden max-h-[85vh]">
            
            {{-- Left Side: Image --}}
            <div class="hidden md:block md:w-5/12 lg:w-1/2 relative bg-zinc-900 border-r border-zinc-800">
                <img src="{{ asset('images/room-hero.png') }}" class="absolute inset-0 w-full h-full object-cover grayscale opacity-90" alt="Workspace Graphic">
                
                <div class="absolute bottom-10 left-10 right-10">
                    <h3 class="text-3xl font-black text-white mb-2 uppercase tracking-widest">War Room</h3>
                    <p class="text-zinc-400 font-bold uppercase tracking-widest text-[10px]">Establish a secure, collaborative workspace for your startup idea.</p>
                </div>
            </div>

            {{-- Right Side: Form --}}
            <div class="w-full md:w-7/12 lg:w-1/2 p-6 sm:p-10 flex flex-col justify-center bg-zinc-950 relative">
                <h2 class="text-2xl sm:text-3xl font-black text-white mb-6 uppercase tracking-widest">Create Room</h2>
                
                <form action="{{ route('venture-rooms.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1.5">Room Name</label>
                        <input type="text" name="name" required class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-white focus:border-white transition placeholder-zinc-600 font-bold" placeholder="E.g. Project Phoenix">
                    </div>

                    <div>
                        <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1.5">Objective / Description</label>
                        <textarea name="description" rows="3" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-white focus:border-white transition placeholder-zinc-600 resize-none font-bold" placeholder="What is the main objective of this venture?"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1.5">Link Project</label>
                            <select name="project_id" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-white focus:border-white transition font-bold appearance-none">
                                <option value="" class="text-zinc-500">-- None --</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1.5">Current Stage</label>
                            <select name="venture_stage_id" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2.5 text-white focus:ring-2 focus:ring-white focus:border-white transition font-bold appearance-none">
                                <option value="" class="text-zinc-500">-- Select Stage --</option>
                                @foreach($stages as $stage)
                                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-3.5 rounded-xl bg-white text-black font-black uppercase tracking-widest border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                            Initialize Workspace
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
