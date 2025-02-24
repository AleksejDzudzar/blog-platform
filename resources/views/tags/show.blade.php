@extends('layouts.app')

@section('title', "Posts for Tag: " . $tag->name)

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-100 text-center">Posts for Tag: {{ $tag->name }}</h1>

        @if ($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($posts as $post)
                    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-xl font-semibold text-indigo-400 hover:text-indigo-600 transition duration-300">
                            {{ $post->title }}
                        </a>
                        <p class="text-gray-400 mt-3">{{ Str::limit($post->content, 150) }}</p>
                        <div class="flex justify-between items-center mt-4 text-gray-500 text-sm">
                            <span>{{ $post->created_at->format('d. M Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            {{ $posts->links() }}
        @else
            <div class="text-center bg-gray-800 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-300">No posts available for this tag</h2>
            </div>
        @endif
    </div>
@endsection
