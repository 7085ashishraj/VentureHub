<x-app-layout>
    <div class="min-h-screen bg-zinc-50 py-10 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-7xl mx-auto">

            {{-- Page Title --}}
            <div class="mb-10">
                <p class="text-[10px] font-black text-zinc-400 uppercase tracking-[0.3em] mb-1">Account Settings</p>
                <h1 class="text-4xl font-black text-zinc-900 uppercase tracking-widest leading-none">My Profile</h1>
                <div class="mt-3 w-12 h-1 bg-zinc-900"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT COLUMN: Profile Preview Card --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- Avatar / Identity Card --}}
                    <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 shadow-2xl flex flex-col items-center text-center relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-600 rounded-bl-full opacity-20"></div>

                        {{-- Avatar --}}
                        <div class="w-24 h-24 rounded-2xl bg-zinc-800 border-2 border-zinc-700 flex items-center justify-center text-4xl font-black text-white shadow-xl mb-4 overflow-hidden">
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" class="w-full h-full object-cover grayscale">
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                        </div>

                        <h2 class="text-xl font-black text-white uppercase tracking-widest">{{ auth()->user()->name }}</h2>
                        <p class="text-zinc-500 text-xs font-bold uppercase tracking-widest mt-1">{{ auth()->user()->email }}</p>

                        @if(auth()->user()->bio)
                            <p class="mt-4 text-zinc-400 text-sm font-medium leading-relaxed border-t border-zinc-800 pt-4">{{ auth()->user()->bio }}</p>
                        @endif

                        {{-- Skills --}}
                        @if(auth()->user()->skills)
                            <div class="mt-5 flex flex-wrap gap-2 justify-center">
                                @foreach(explode(',', auth()->user()->skills) as $skill)
                                    <span class="text-[10px] font-black uppercase tracking-widest bg-zinc-800 text-white px-3 py-1 rounded-full border border-zinc-700">{{ trim($skill) }}</span>
                                @endforeach
                            </div>
                        @endif

                        {{-- Social Links --}}
                        <div class="mt-6 flex gap-3 border-t border-zinc-800 pt-6 w-full justify-center">
                            @if(auth()->user()->linkedin)
                                <a href="{{ auth()->user()->linkedin }}" target="_blank" class="flex items-center gap-1.5 text-[10px] font-black text-blue-400 hover:text-white uppercase tracking-widest transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    LinkedIn
                                </a>
                            @endif
                            @if(auth()->user()->github)
                                <a href="{{ auth()->user()->github }}" target="_blank" class="flex items-center gap-1.5 text-[10px] font-black text-zinc-400 hover:text-white uppercase tracking-widest transition-colors">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                                    GitHub
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Stats Card --}}
                    <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-6 shadow-2xl">
                        <h3 class="text-[10px] font-black text-zinc-500 uppercase tracking-widest mb-5">Account Overview</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-3 border-b border-zinc-800">
                                <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">Member Since</span>
                                <span class="text-white font-black text-xs">{{ auth()->user()->created_at->format('M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-zinc-800">
                                <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">Verified</span>
                                <span class="text-xs font-black {{ auth()->user()->is_verified ? 'text-blue-400' : 'text-zinc-500' }} uppercase tracking-widest">
                                    {{ auth()->user()->is_verified ? '✓ Yes' : 'No' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-[10px] font-black text-zinc-500 uppercase tracking-widest">Skills Listed</span>
                                <span class="text-white font-black text-xs">
                                    {{ auth()->user()->skills ? count(explode(',', auth()->user()->skills)) : 0 }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: Forms --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Profile Information Form --}}
                    <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 sm:p-10 shadow-2xl">
                        <div class="border-b border-zinc-800 pb-6 mb-8">
                            <h2 class="text-xl font-black text-white uppercase tracking-widest">Profile Information</h2>
                            <p class="text-zinc-500 text-xs font-bold uppercase tracking-widest mt-1">Update your name, email, bio and links.</p>
                        </div>

                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Name</label>
                                    <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-zinc-600">
                                    @error('name')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Email</label>
                                    <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-zinc-600">
                                    @error('email')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div>
                                <label for="bio" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Bio / Elevator Pitch</label>
                                <textarea id="bio" name="bio" rows="3"
                                    class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-zinc-600 resize-none">{{ old('bio', auth()->user()->bio) }}</textarea>
                                @error('bio')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="skills" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Skills <span class="text-zinc-600">(comma separated)</span></label>
                                <input id="skills" name="skills" type="text" value="{{ old('skills', auth()->user()->skills) }}"
                                    class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-zinc-600"
                                    placeholder="e.g. React, Laravel, Figma">
                                @error('skills')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="linkedin" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">LinkedIn URL</label>
                                    <input id="linkedin" name="linkedin" type="text" value="{{ old('linkedin', auth()->user()->linkedin) }}"
                                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-zinc-600"
                                        placeholder="https://linkedin.com/in/...">
                                    @error('linkedin')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="github" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">GitHub URL</label>
                                    <input id="github" name="github" type="text" value="{{ old('github', auth()->user()->github) }}"
                                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-zinc-600"
                                        placeholder="https://github.com/...">
                                    @error('github')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div>
                                <label for="profile_image" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Profile Image URL</label>
                                <input id="profile_image" name="profile_image" type="text" value="{{ old('profile_image', auth()->user()->profile_image) }}"
                                    class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-zinc-600"
                                    placeholder="https://...">
                                @error('profile_image')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                            </div>

                            <div class="flex items-center gap-4 pt-2">
                                <button type="submit" class="px-8 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest transition-all shadow-[4px_4px_0px_0px_rgba(37,99,235,0.4)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                                    Save Profile
                                </button>
                                @if(session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)"
                                        class="text-xs font-black text-blue-400 uppercase tracking-widest">✓ Saved!</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    {{-- Password Form --}}
                    <div class="bg-zinc-900 rounded-3xl border border-zinc-800 p-8 sm:p-10 shadow-2xl">
                        <div class="border-b border-zinc-800 pb-6 mb-8">
                            <h2 class="text-xl font-black text-white uppercase tracking-widest">Update Password</h2>
                            <p class="text-zinc-500 text-xs font-bold uppercase tracking-widest mt-1">Use a long, random password to stay secure.</p>
                        </div>

                        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                                <div>
                                    <label for="update_password_current_password" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Current</label>
                                    <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    @error('current_password', 'updatePassword')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="update_password_password" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">New Password</label>
                                    <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    @error('password', 'updatePassword')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                                </div>
                                <div>
                                    <label for="update_password_password_confirmation" class="block text-[10px] font-black text-zinc-400 uppercase tracking-widest mb-2">Confirm</label>
                                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                                        class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white font-bold focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                    @error('password_confirmation', 'updatePassword')<p class="mt-1 text-xs text-red-400 font-bold">{{ $message }}</p>@enderror
                                </div>
                            </div>

                            <div class="flex items-center gap-4 pt-2">
                                <button type="submit" class="px-8 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-black uppercase tracking-widest transition-all shadow-[4px_4px_0px_0px_rgba(37,99,235,0.4)] hover:shadow-none hover:translate-x-1 hover:translate-y-1">
                                    Update Password
                                </button>
                                @if(session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 2500)"
                                        class="text-xs font-black text-blue-400 uppercase tracking-widest">✓ Updated!</p>
                                @endif
                            </div>
                        </form>
                    </div>

                    {{-- Delete Account --}}
                    <div class="bg-zinc-900 rounded-3xl border border-red-900/40 p-8 sm:p-10 shadow-2xl">
                        <div class="border-b border-zinc-800 pb-6 mb-8">
                            <h2 class="text-xl font-black text-red-400 uppercase tracking-widest">Danger Zone</h2>
                            <p class="text-zinc-500 text-xs font-bold uppercase tracking-widest mt-1">Permanently delete your account and all data.</p>
                        </div>
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
