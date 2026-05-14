<?php

namespace App\Http\Controllers;

use App\Models\Pitch;
use Illuminate\Http\Request;

class PitchController extends Controller
{
    public function index()
    {
        $pitches = Pitch::with('user')->latest()->get();
        return view('pitches.index', compact('pitches'));
    }

    public function create()
    {
        return view('pitches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'problem' => 'required|string',
            'solution' => 'required|string',
            'market' => 'nullable|string',
            'ask' => 'nullable|string',
        ]);

        $request->user()->pitches()->create($validated);

        return redirect()->route('pitches.index')->with('success', 'Pitch submitted successfully.');
    }

    public function show(Pitch $pitch)
    {
        return view('pitches.show', compact('pitch'));
    }
}
