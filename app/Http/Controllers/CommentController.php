<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request,Post $post)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->user()->associate(Auth::user());
        $comment->post()->associate($post);
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully');

    }
}
