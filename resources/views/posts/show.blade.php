@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold text-gray-100 text-center">{{ $post->title }}</h1>

        <div class="flex items-center justify-center text-gray-400 text-sm mt-2">
            <span class="flex items-center">
                <img src="{{ asset('storage/' . (auth()->user()->avatar ?? 'default-avatar.png')) }}" alt="Avatar"
                     class="w-8 h-8 rounded-full mr-2">
                <a href="#" class="text-indigo-400 hover:underline">
                    {{ $post->user->name }}
                </a>
            </span>
            <span class="mx-2">|</span>
            <span>Published: {{ $post->created_at->format('d. M Y') }}</span>
            <span class="mx-2">|</span>
            <span>Views: {{ $post->views }}</span>
        </div>

        <!-- Category -->
        <div class="mt-4 text-center text-gray-300">
            <strong>Category:</strong> <span class="text-indigo-400">{{ $post->category->name }}</span>
        </div>

        <!-- Tags -->
        <div class="mt-4 text-center text-gray-300">
            <strong>Tags:</strong>
            @foreach($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->slug) }}" class="text-indigo-400 hover:underline">{{ $tag->name }}</a>
                @if (!$loop->last), @endif
            @endforeach
        </div>

        <div class="mt-6 text-gray-300 leading-relaxed">
            {!! nl2br(e($post->content)) !!}
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-indigo-400 hover:underline">Back to Home</a>
        </div>

        <!-- Comment Section -->
        <div class="mt-10 bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="text-xl text-gray-100 mb-4">Comments</h2>

            @foreach($post->comments as $comment)
                <div class="border-b border-gray-700 pb-2 mb-2">
                    <p class="text-gray-300"><strong>{{ $comment->user->name }}</strong></p>
                    <p class="text-gray-300 mt-1">{{ $comment->content }}</p>
                    <p class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @endforeach

            @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" class="w-full p-2 bg-gray-700 text-gray-300 rounded-lg" rows="3" placeholder="Write a comment..."></textarea>
                    <button type="submit" class="mt-2 bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600">Post Comment</button>
                </form>
            @else
                <p class="text-gray-400 mt-2">You must be <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">logged in</a> to comment.</p>
            @endauth
        </div>
    </div>
@endsection
