<?php

namespace App\Http\Controllers;

use App\Models\LeanCanvas;
use Illuminate\Http\Request;

class LeanCanvasController extends Controller
{
    public function update(Request $request, LeanCanvas $lean_canva)
    {
        $validated = $request->validate([
            'problem' => 'nullable|string',
            'solution' => 'nullable|string',
            'key_metrics' => 'nullable|string',
            'value_proposition' => 'nullable|string',
            'unfair_advantage' => 'nullable|string',
            'channels' => 'nullable|string',
            'customer_segments' => 'nullable|string',
            'cost_structure' => 'nullable|string',
            'revenue_streams' => 'nullable|string',
        ]);
        
        $lean_canva->update($validated);
        
        return back()->with('success', 'Lean Canvas updated successfully.');
    }
}
