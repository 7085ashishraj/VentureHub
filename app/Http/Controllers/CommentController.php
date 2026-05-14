<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate(['content' => 'required|string|max:1000']);
        
        $post->comments()->create([
            'user_id' => $request->user()->id,
            'content' => $request->input('content'),
        ]);
        
        return back()->with('success', 'Comment added!');
    }
}
