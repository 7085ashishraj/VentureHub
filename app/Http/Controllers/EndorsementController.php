<?php

namespace App\Http\Controllers;

use App\Models\SkillEndorsement;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

class EndorsementController extends Controller
{
    public function store(Request $request, User $user, Skill $skill)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot endorse yourself.');
        }

        SkillEndorsement::firstOrCreate([
            'endorser_id' => auth()->id(),
            'endorsee_id' => $user->id,
            'skill_id' => $skill->id,
        ]);

        return back()->with('success', 'Skill endorsed!');
    }
}
