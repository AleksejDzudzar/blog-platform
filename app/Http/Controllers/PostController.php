<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('home', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $slug = $request->slug ?: Str::slug($request->title);

        $originalSlug = $slug;
        $counter = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        DB::beginTransaction();

        try {
            // Kreiraj post
            $post = Post::create([
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => auth()->id(),
                'published_at' => now(),
            ]);

            // Nema potrebe za tagovima, pa se ovaj deo uklanja.

            DB::commit();

            return redirect()->route('home')->with('success', 'Post created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if (!session()->has('viewed_post_' . $post->id)) {
            $post->increment('views');
            session()->put('viewed_post_' . $post->id, true);
        }

        return view('posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
