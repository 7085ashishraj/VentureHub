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
}
