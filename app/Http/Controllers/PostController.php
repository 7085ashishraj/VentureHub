<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments.user'])->latest()->get();
        return view('dashboard', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        
        $request->user()->posts()->create($request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        return redirect()->route('dashboard')->with('success', 'Idea pitched successfully!');
    }
}
