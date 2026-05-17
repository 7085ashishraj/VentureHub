<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('organizer')->orderBy('event_date', 'asc')->get();
        return view('events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('events', 'public');
        }

        $request->user()->events()->create($validated);

        return back()->with('success', 'Event scheduled successfully!');
    }

    public function show(Event $event)
    {
        $event->load(['organizer', 'tickets.user']);
        
        $interestedCount = $event->tickets()->where('status', 'interested')->count();
        $purchasedCount = $event->tickets()->where('status', 'purchased')->count();
        
        $userTicket = null;
        if (auth()->check()) {
            $userTicket = $event->tickets()->where('user_id', auth()->id())->first();
        }

        return view('events.show', compact('event', 'interestedCount', 'purchasedCount', 'userTicket'));
    }

    public function ticket(Request $request, Event $event)
    {
        $validated = $request->validate([
            'status' => 'required|in:interested,purchased'
        ]);

        $ticket = $event->tickets()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['status' => $validated['status']]
        );

        $message = $validated['status'] === 'purchased' ? 'You have successfully secured a ticket!' : 'You have marked yourself as interested.';
        return back()->with('success', $message);
    }
}
