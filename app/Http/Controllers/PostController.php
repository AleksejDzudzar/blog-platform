<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Services\PostService;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        $posts = $this->postService->getPosts($request->input('search'));
        return view('home', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        if ($this->postService->createPost($request)) {
            return redirect()->route('home')->with('success', 'Post created successfully.');
        }
        return redirect()->route('home')->with('error', 'Failed to create post. Please try again.');
    }

    public function show($slug)
    {
        $post = $this->postService->getPostBySlug($slug);
        return view('posts.show', compact('post'));
    }
}
