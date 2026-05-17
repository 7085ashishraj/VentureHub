<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $users = \App\Models\User::all();
        return view('network.index', compact('users'));
    }

    public function show(\App\Models\User $user): View
    {
        $user->load(['profile', 'skills', 'needs']);

        $mutualConnections = 0;
        
        if (auth()->check() && auth()->id() !== $user->id) {
            $authId = auth()->id();
            
            $authUserConnections = \App\Models\Connection::where('status', 'accepted')
                ->where(function($q) use ($authId) {
                    $q->where('requester_id', $authId)->orWhere('recipient_id', $authId);
                })
                ->get()
                ->map(fn($c) => $c->requester_id === $authId ? $c->recipient_id : $c->requester_id)
                ->toArray();

            $viewedUserConnections = \App\Models\Connection::where('status', 'accepted')
                ->where(function($q) use ($user) {
                    $q->where('requester_id', $user->id)->orWhere('recipient_id', $user->id);
                })
                ->get()
                ->map(fn($c) => $c->requester_id === $user->id ? $c->recipient_id : $c->requester_id)
                ->toArray();

            $mutualConnections = count(array_intersect($authUserConnections, $viewedUserConnections));
        }
        return view('profile.matrix', compact('user', 'mutualConnections'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
