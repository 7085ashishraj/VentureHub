<x-app-layout>
    <div class="min-h-screen bg-zinc-100 dark:bg-zinc-950 text-zinc-200 py-8 px-4 sm:px-6 lg:px-8 font-sans h-[calc(100vh-65px)] flex flex-col">
        <div class="max-w-7xl mx-auto w-full flex-grow flex gap-6 overflow-hidden">
            
            {{-- Sidebar: Connections List --}}
            <div class="w-1/3 bg-zinc-900 rounded-3xl border border-zinc-800 flex flex-col overflow-hidden shadow-2xl">
                <div class="p-6 border-b border-zinc-800">
                    <h2 class="text-xl font-black text-white flex items-center gap-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        Messages
                    </h2>
                </div>
                <div class="flex-grow overflow-y-auto p-4 space-y-2">
                    @forelse($connections as $connection)
                        @php
                            $isActive = $activeUser && $activeUser->id === $connection->id;
                            $unreadCount = \App\Models\Message::where('sender_id', $connection->id)
                                            ->where('receiver_id', auth()->id())
                                            ->where('is_read', false)
                                            ->count();
                        @endphp
                        <a href="{{ route('messages.index', $connection) }}" class="flex items-center gap-3 p-3 rounded-2xl transition {{ $isActive ? 'bg-zinc-800 shadow-md border border-zinc-700' : 'hover:bg-zinc-800/50 border border-transparent' }}">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-800 flex-shrink-0">
                                    @if($connection->profile_image)
                                        <img src="{{ asset('storage/' . $connection->profile_image) }}" class="w-full h-full object-cover grayscale">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-zinc-900 text-white font-bold">
                                            {{ substr($connection->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="absolute bottom-0 right-0 w-3 h-3 bg-white rounded-full border-2 border-zinc-900"></div>
                            </div>
                            <div class="flex-grow overflow-hidden">
                                <div class="font-bold {{ $isActive ? 'text-white' : 'text-zinc-300' }} truncate">{{ $connection->name }}</div>
                                <div class="text-xs text-zinc-500 truncate">{{ $connection->profile?->role ?? 'Network Connection' }}</div>
                            </div>
                            @if($unreadCount > 0)
                                <div class="bg-white text-black text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center flex-shrink-0">
                                    {{ $unreadCount }}
                                </div>
                            @endif
                        </a>
                    @empty
                        <div class="text-center p-6 text-zinc-500 text-sm">
                            You don't have any connections yet.
                            <br><a href="{{ route('network.index') }}" class="text-white hover:underline mt-2 inline-block">Find people to connect with</a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Main Chat Area --}}
            <div class="w-2/3 bg-zinc-950 rounded-3xl border border-zinc-800 flex flex-col overflow-hidden shadow-2xl relative">
                @if($activeUser)
                    {{-- Chat Header --}}
                    <div class="p-6 border-b border-zinc-800 bg-zinc-900 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden bg-zinc-800 flex-shrink-0">
                                @if($activeUser->profile_image)
                                    <img src="{{ asset('storage/' . $activeUser->profile_image) }}" class="w-full h-full object-cover grayscale">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-zinc-900 text-white font-bold">
                                        {{ substr($activeUser->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('network.show', $activeUser) }}" class="font-bold text-white text-lg hover:text-zinc-300 transition">{{ $activeUser->name }}</a>
                                <div class="text-xs text-zinc-500 flex items-center gap-1">
                                    <span class="w-2 h-2 rounded-full bg-white inline-block"></span> Connected
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Chat History --}}
                    <div class="flex-grow p-6 overflow-y-auto space-y-4" id="chat-history">
                        @forelse($messages as $msg)
                            @php
                                $isMine = $msg->sender_id === auth()->id();
                            @endphp
                            <div class="flex {{ $isMine ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-[70%]">
                                    <div class="flex items-end gap-2 {{ $isMine ? 'flex-row-reverse' : 'flex-row' }}">
                                        
                                        {{-- Avatar for other user --}}
                                        @if(!$isMine)
                                            <div class="w-8 h-8 rounded-full overflow-hidden bg-zinc-800 flex-shrink-0 mb-5 border border-zinc-700">
                                                @if($msg->sender->profile_image)
                                                    <img src="{{ asset('storage/' . $msg->sender->profile_image) }}" class="w-full h-full object-cover grayscale">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center bg-zinc-900 text-white font-bold text-xs">
                                                        {{ substr($msg->sender->name, 0, 1) }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endif

                                        {{-- Message Bubble --}}
                                        <div class="{{ $isMine ? 'bg-white text-black rounded-2xl rounded-tr-sm border border-zinc-200' : 'bg-zinc-900 text-white rounded-2xl rounded-tl-sm border border-zinc-800' }} p-4 shadow-md">
                                            @if($msg->attachment_path)
                                                @php $ext = pathinfo($msg->attachment_path, PATHINFO_EXTENSION); @endphp
                                                @if(in_array(strtolower($ext), ['jpg','jpeg','png','gif']))
                                                    <div class="mb-2 rounded-xl overflow-hidden cursor-pointer" onclick="window.open('{{ asset('storage/' . $msg->attachment_path) }}', '_blank')">
                                                        <img src="{{ asset('storage/' . $msg->attachment_path) }}" class="max-h-48 w-auto hover:opacity-90 transition">
                                                    </div>
                                                @else
                                                    <a href="{{ asset('storage/' . $msg->attachment_path) }}" target="_blank" class="flex items-center gap-2 p-2 bg-black/20 rounded-lg mb-2 hover:bg-black/30 transition text-sm font-semibold">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                                        Download File
                                                    </a>
                                                @endif
                                            @endif
                                            
                                            @if($msg->content)
                                                <p class="text-[15px] leading-relaxed break-words">{!! nl2br(e($msg->content)) !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-[10px] text-zinc-500 mt-1 px-1 {{ $isMine ? 'text-right' : 'text-left ml-10' }}">
                                        {{ $msg->created_at->format('h:i A') }} 
                                        @if($isMine)
                                            <span class="ml-1 text-black font-bold">{{ $msg->is_read ? '✓✓' : '✓' }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="h-full flex flex-col items-center justify-center text-zinc-500">
                                <svg class="w-16 h-16 mb-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                <p>No messages yet. Say hello!</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Message Input --}}
                    <div class="p-4 border-t border-zinc-800 bg-zinc-900">
                        <form action="{{ route('messages.store', $activeUser) }}" method="POST" enctype="multipart/form-data" class="flex items-end gap-2 relative">
                            @csrf
                            
                            {{-- File Upload Button --}}
                            <div class="relative shrink-0">
                                <input type="file" name="attachment" id="attachment" class="hidden" onchange="document.getElementById('file-name').textContent = this.files[0].name; document.getElementById('file-preview').classList.remove('hidden')">
                                <label for="attachment" class="w-10 h-10 flex items-center justify-center rounded-full bg-zinc-800 text-zinc-400 hover:text-white hover:bg-zinc-700 cursor-pointer transition border border-zinc-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                </label>
                            </div>

                            {{-- Text Input --}}
                            <div class="flex-grow relative">
                                <div id="file-preview" class="hidden absolute bottom-full mb-2 left-0 bg-zinc-800 text-xs text-zinc-300 py-1 px-3 rounded-full border border-zinc-700 flex items-center gap-2 shadow-lg">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    <span id="file-name" class="max-w-[150px] truncate">file.jpg</span>
                                    <button type="button" onclick="document.getElementById('attachment').value=''; document.getElementById('file-preview').classList.add('hidden')" class="text-zinc-500 hover:text-red-400 ml-1">✕</button>
                                </div>
                                <textarea name="content" rows="1" class="w-full bg-transparent border border-zinc-600 rounded-xl px-4 py-3 text-white text-lg focus:ring-0 focus:border-white transition-colors resize-none max-h-32 placeholder-zinc-700" placeholder="Type a message..." oninput="this.style.height = ''; this.style.height = Math.min(this.scrollHeight, 128) + 'px'"></textarea>
                            </div>

                            {{-- Send Button --}}
                            <button type="submit" class="shrink-0 w-12 h-12 flex items-center justify-center bg-white text-black border border-transparent transition-all shadow-[4px_4px_0px_0px_rgba(255,255,255,0.2)] hover:shadow-none hover:translate-x-[4px] hover:translate-y-[4px]">
                                <svg class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                            </button>
                        </form>
                    </div>

                    <script>
                        // Scroll to bottom of chat
                        const chatHistory = document.getElementById('chat-history');
                        chatHistory.scrollTop = chatHistory.scrollHeight;
                        
                        // Submit form on Enter (without Shift)
                        document.querySelector('textarea[name="content"]').addEventListener('keydown', function(e) {
                            if (e.key === 'Enter' && !e.shiftKey) {
                                e.preventDefault();
                                this.closest('form').submit();
                            }
                        });
                    </script>
                @else
                    <div class="h-full flex flex-col items-center justify-center text-zinc-500 p-8 text-center bg-zinc-950">
                        <div class="w-24 h-24 rounded-full bg-zinc-900 flex items-center justify-center mb-6 border border-zinc-800">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-2">Select a Conversation</h2>
                        <p class="max-w-xs text-sm">Choose a connection from the left menu to start discussing ideas, sharing files, and collaborating.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
