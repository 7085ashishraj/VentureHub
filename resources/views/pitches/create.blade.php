<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-zinc-900 dark:text-white leading-tight">
            {{ __('Pitch Your Idea') }}
        </h2>
    </x-slot>

    {{-- Use h-[calc(100vh-140px)] so it exactly fills the remaining height in the dashboard layout without scrolling --}}
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 flex items-center justify-center min-h-[calc(100vh-140px)] py-6">
        
        <div class="w-full flex rounded-3xl bg-zinc-950 border border-zinc-800 shadow-2xl overflow-hidden max-h-[85vh]">
            
            {{-- Left Side: Image --}}
            <div class="hidden md:block md:w-5/12 lg:w-1/2 relative bg-zinc-900">
                <img src="{{ asset('images/pitch-hero.png') }}" class="absolute inset-0 w-full h-full object-cover grayscale opacity-90" alt="Pitch Graphic">

                
                <div class="absolute bottom-10 left-10 right-10">
                    <h3 class="text-3xl font-black text-white mb-2 uppercase tracking-widest">Deal Flow</h3>
                    <p class="text-zinc-400 font-bold">Skip the slide deck. Give investors the structured data they want, instantly.</p>
                </div>
            </div>

            {{-- Right Side: Form --}}
            <div class="w-full md:w-7/12 lg:w-1/2 p-6 sm:p-8 flex flex-col justify-center bg-zinc-950 relative border-l border-zinc-800">
                <h2 class="text-2xl sm:text-3xl font-black text-white mb-5 uppercase tracking-widest">Submit Pitch</h2>
                
                <form action="{{ route('pitches.store') }}" method="POST" class="space-y-3">
                    @csrf
                    
                    <div>
                        <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1">Pitch Title</label>
                        <input type="text" name="title" required class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-white focus:border-white transition placeholder-zinc-600 font-bold" placeholder="E.g. Next-Gen AI Legal Assistant">
                    </div>

                    <div>
                        <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1">The Problem</label>
                        <textarea name="problem" required rows="2" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-white focus:border-white transition placeholder-zinc-600 resize-none font-bold" placeholder="What pain point are you solving?"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1">The Solution</label>
                        <textarea name="solution" required rows="2" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-white focus:border-white transition placeholder-zinc-600 resize-none font-bold" placeholder="How does your product solve the problem uniquely?"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1">Market Size</label>
                            <textarea name="market" rows="2" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-white focus:border-white transition placeholder-zinc-600 resize-none font-bold" placeholder="Target audience"></textarea>
                        </div>
                        <div>
                            <label class="block text-[10px] sm:text-xs font-black text-zinc-400 uppercase tracking-widest mb-1">The Ask</label>
                            <textarea name="ask" rows="2" class="w-full bg-zinc-900 border border-zinc-800 rounded-xl px-4 py-2 text-white focus:ring-2 focus:ring-white focus:border-white transition placeholder-zinc-600 resize-none font-bold" placeholder="E.g. Seeking $500k Seed"></textarea>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3 rounded-xl bg-white text-black font-black uppercase tracking-widest border border-transparent transition-all shadow-[6px_6px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[6px] hover:translate-y-[6px]">
                            Publish to Pipeline
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</x-app-layout>
