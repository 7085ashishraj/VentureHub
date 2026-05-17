<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Models\Connection;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request, User $user = null)
    {
        $currentUserId = auth()->id();

        // Get all accepted connections for the current user to build the sidebar
        $connections = Connection::with(['requester', 'recipient'])
            ->where('status', 'accepted')
            ->where(function ($query) use ($currentUserId) {
                $query->where('requester_id', $currentUserId)
                      ->orWhere('recipient_id', $currentUserId);
            })
            ->get()
            ->map(function ($conn) use ($currentUserId) {
                return $conn->requester_id === $currentUserId ? $conn->recipient : $conn->requester;
            });

        $activeUser = $user;
        $messages = [];

        if ($activeUser) {
            // Check if they are actually connected
            $isConnected = $connections->contains('id', $activeUser->id);
            if (!$isConnected) {
                abort(403, 'You can only message your connections.');
            }

            // Mark messages from this user as read
            Message::where('sender_id', $activeUser->id)
                ->where('receiver_id', $currentUserId)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            // Fetch conversation history
            $messages = Message::with('sender')
                ->where(function ($q) use ($currentUserId, $activeUser) {
                    $q->where('sender_id', $currentUserId)->where('receiver_id', $activeUser->id);
                })
                ->orWhere(function ($q) use ($currentUserId, $activeUser) {
                    $q->where('sender_id', $activeUser->id)->where('receiver_id', $currentUserId);
                })
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('messages.index', compact('connections', 'activeUser', 'messages'));
    }

    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'content' => 'required_without:attachment|nullable|string',
            'attachment' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:10240', // 10MB max
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment_path'] = $request->file('attachment')->store('attachments', 'public');
        }

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $validated['content'] ?? null,
            'attachment_path' => $validated['attachment_path'] ?? null,
        ]);

        return back();
    }
}
