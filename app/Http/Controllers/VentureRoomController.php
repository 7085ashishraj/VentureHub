<?php

namespace App\Http\Controllers;

use App\Models\VentureRoom;
use App\Models\Project;
use App\Models\VentureStage;
use Illuminate\Http\Request;

class VentureRoomController extends Controller
{
    public function index()
    {
        $rooms = VentureRoom::with(['creator', 'project', 'ventureStage'])->get();
        return view('venture-rooms.index', compact('rooms'));
    }

    public function create()
    {
        $projects = Project::where('user_id', auth()->id())->get();
        $stages = VentureStage::orderBy('order_index')->get();
        return view('venture-rooms.create', compact('projects', 'stages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'nullable|exists:projects,id',
            'venture_stage_id' => 'nullable|exists:venture_stages,id',
        ]);

        $validated['creator_id'] = auth()->id();
        
        $room = VentureRoom::create($validated);
        
        // Auto-create an empty lean canvas for the room
        $room->leanCanvas()->create();
        
        // Add creator as admin member
        $room->members()->create([
            'user_id' => auth()->id(),
            'role' => 'admin'
        ]);

        return redirect()->route('venture-rooms.show', $room);
    }

    public function show(VentureRoom $venture_room)
    {
        $venture_room->load(['creator', 'project', 'ventureStage', 'members.user', 'leanCanvas', 'milestones.assignee']);
        return view('venture-rooms.show', compact('venture_room'));
    }

    public function edit(VentureRoom $ventureRoom)
    {
        //
    }

    public function update(Request $request, VentureRoom $ventureRoom)
    {
        //
    }

    public function destroy(VentureRoom $ventureRoom)
    {
        //
    }
}
