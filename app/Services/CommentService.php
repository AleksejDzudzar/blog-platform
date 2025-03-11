<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function addComment(Post $post, string $content): bool
    {
        $comment = new Comment();
        $comment->content = $content;
        $comment->user()->associate(Auth::user());
        $comment->post()->associate($post);

        return $comment->save();
    }
}
