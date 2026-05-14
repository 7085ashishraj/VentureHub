<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\VentureRoom;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function store(Request $request, VentureRoom $venture_room)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_to' => 'nullable|exists:users,id',
        ]);
        
        $venture_room->milestones()->create($validated);
        
        return back()->with('success', 'Milestone added.');
    }

    public function update(Request $request, Milestone $milestone)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ]);
        
        $milestone->update($validated);
        
        return back()->with('success', 'Milestone updated.');
    }
}
