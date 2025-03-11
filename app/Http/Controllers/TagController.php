<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Services\TagService;

class TagController extends Controller
{
    protected TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function show(Tag $tag)
    {
        $posts = $this->tagService->getPostsByTag($tag);

        return view('tags.show', compact('posts', 'tag'));
    }
}
