<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\CommentService;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required'
        ]);

        if ($this->commentService->addComment($post, $request->input('content'))) {
            return redirect()->back()->with('success', 'Comment added successfully');
        }

        return redirect()->back()->with('error', 'Failed to add comment');
    }
}
