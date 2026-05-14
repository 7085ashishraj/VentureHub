<?php

namespace App\Http\Controllers;

use App\Models\SweatEquityTask;
use App\Models\VentureRoom;
use Illuminate\Http\Request;

class SweatEquityTaskController extends Controller
{
    public function store(Request $request, VentureRoom $ventureRoom)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'credits_offered' => 'required|integer|min:0',
        ]);

        $ventureRoom->sweatEquityTasks()->create($validated);

        return back()->with('success', 'Sweat equity task created.');
    }

    public function claim(Request $request, SweatEquityTask $task)
    {
        $task->update([
            'status' => 'assigned',
            'assigned_to' => auth()->id()
        ]);

        return back()->with('success', 'You have claimed this task.');
    }

    public function complete(Request $request, SweatEquityTask $task)
    {
        $task->update([
            'status' => 'completed',
        ]);

        return back()->with('success', 'Task marked as completed.');
    }
}
