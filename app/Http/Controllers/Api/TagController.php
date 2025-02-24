<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function show(Tag $tag)
    {
        $posts = $tag->posts()->paginate(10);

        return response()->json([
            'tag' => $tag,
            'posts' => $posts
        ]);
    }
}

