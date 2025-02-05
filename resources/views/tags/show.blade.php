@extends('layouts.app')

@section('title', 'Posts for ' . $tag->name)

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-100 text-center">{{ $tag->name }} Posts</h1>

        @foreach($posts as $post)
            <div class="mt-4">
                <a href="{{ route('posts.show', $post) }}" class="text-indigo-400 hover:underline">{{ $post->title }}</a>
            </div>
        @endforeach
    </div>
@endsection
