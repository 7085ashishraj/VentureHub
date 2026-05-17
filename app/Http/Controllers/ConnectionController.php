<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    public function store(Request $request, User $user)
    {
        // Prevent self-connection
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot connect with yourself.');
        }

        // Prevent duplicate connection requests
        $exists = Connection::where(function ($q) use ($user) {
                $q->where('requester_id', auth()->id())
                  ->where('recipient_id', $user->id);
            })->orWhere(function ($q) use ($user) {
                $q->where('requester_id', $user->id)
                  ->where('recipient_id', auth()->id());
            })->exists();

        if ($exists) {
            return back()->with('info', 'Connection request already sent or you are already connected.');
        }

        Connection::create([
            'requester_id' => auth()->id(),
            'recipient_id' => $user->id,
            'status'       => 'pending',
        ]);

        return back()->with('success', 'Connection request sent to ' . $user->name . '!');
    }
    public function index()
    {
        $userId = auth()->id();
        
        // Pending requests received by the current user
        $pendingRequests = Connection::with('requester')
            ->where('recipient_id', $userId)
            ->where('status', 'pending')
            ->get();
            
        // Accepted connections
        $connections = Connection::with(['requester', 'recipient'])
            ->where('status', 'accepted')
            ->where(function ($query) use ($userId) {
                $query->where('requester_id', $userId)
                      ->orWhere('recipient_id', $userId);
            })
            ->get();

        return view('network.connections', compact('pendingRequests', 'connections'));
    }

    public function update(Request $request, Connection $connection)
    {
        // Ensure the current user is the recipient of the pending request
        if ($connection->recipient_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $connection->update(['status' => $validated['status']]);

        return back()->with('success', 'Connection request ' . $validated['status'] . '.');
    }

    public function destroy(Connection $connection)
    {
        // Ensure the current user is part of the connection
        if ($connection->requester_id !== auth()->id() && $connection->recipient_id !== auth()->id()) {
            abort(403);
        }

        $connection->delete();

        return back()->with('success', 'Connection removed.');
    }
}
