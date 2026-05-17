<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('user')->latest()->get();
        return view('projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'required_skills' => 'nullable|string',
            'status' => 'required|string|in:open,closed',
        ]);
        
        $request->user()->projects()->create($validated);

        return back()->with('success', 'Project posted successfully!');
    }

    public function show(Project $project)
    {
        $project->load(['user', 'ventureStage', 'joinedUsers']);
        return view('projects.show', compact('project'));
    }

    public function join(Project $project)
    {
        $user = auth()->user();
        if ($project->joinedUsers()->where('user_id', $user->id)->exists()) {
            $project->joinedUsers()->detach($user->id);
            return back()->with('success', 'You have left the project.');
        } else {
            $project->joinedUsers()->attach($user->id);
            return back()->with('success', 'You have joined the project.');
        }
    }
}
