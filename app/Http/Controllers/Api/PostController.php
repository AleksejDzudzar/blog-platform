<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $posts = Post::with(['category', 'tags', 'images'])
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('tags', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('category', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%");
                    });
            })
            ->paginate(10);

        return response()->json($posts);
    }

    public function store(StorePostRequest $request)
    {
        $attributes = $request->validated();

        $slug = $attributes['slug'] ?? Str::slug($attributes['title']);
        $originalSlug = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        DB::beginTransaction();

        try {
            $post = Post::create([
                'title' => $attributes['title'],
                'slug' => $slug,
                'content' => $attributes['content'],
                'category_id' => $attributes['category_id'],
                'user_id' => auth()->id(),
                'views' => 0,
                'published_at' => now(),
            ]);

            if (!empty($attributes['new_tags'])) {
                $tags = explode(',', $attributes['new_tags']);
                $tagIds = [];

                foreach ($tags as $tagName) {
                    $tagName = trim($tagName);
                    if ($tagName) {
                        $tag = Tag::firstOrCreate(['name' => $tagName]);
                        $tagIds[] = $tag->id;
                    }
                }

                $post->tags()->sync($tagIds);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('posts', 'public');

                    PostImage::create([
                        'post_id' => $post->id,
                        'image_path' => $path,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['message' => 'Post created successfully', 'post' => $post], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred', 'message' => $e->getMessage()], 500);
        }
    }

    public function show($slug)
    {
        $post = Post::with(['images', 'category', 'tags'])->where('slug', $slug)->first();

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->increment('views');

        return response()->json($post);
    }

}

