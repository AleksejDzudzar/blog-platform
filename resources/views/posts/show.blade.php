@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-md">
        <!-- Post Title -->
        <h1 class="text-3xl font-bold text-gray-100 text-center">{{ $post->title }}</h1>

        <!-- Post Information -->
        <div class="flex items-center justify-center text-gray-400 text-sm mt-4">
            <span class="flex items-center">
                <img src="{{ asset('storage/' . ($post->user->avatar ?? 'default-avatar.png')) }}" alt="Avatar"
                     class="w-8 h-8 rounded-full mr-2">
                <a href="{{ route('profile.show', $post->user) }}" class="text-indigo-400 hover:underline">
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
                <a href="{{ route('tags.show', $tag) }}"
                   class="bg-gray-700 text-white px-2 py-1 rounded-md text-sm hover:bg-indigo-600 transition mr-2">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        <!-- Images -->
        @if ($post->images->isNotEmpty())
            <div class="mt-6">
                <h3 class="text-xl font-bold text-gray-100">Images</h3>
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($post->images as $image)
                        <div class="flex justify-center">
                            <a href="{{ asset('storage/' . $image->image_path) }}" data-lightbox="post-images"
                               data-title="Post Image">
                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Post Image"
                                     class="rounded-lg shadow-md max-h-96 object-cover">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Post Content -->
        <div class="mt-6 text-gray-300 leading-relaxed">
            {!! nl2br(e($post->content)) !!}
        </div>

        <!-- Back to Home -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-indigo-400 hover:underline">Back to Home</a>
        </div>

        <!-- Chat Button -->
        @auth
            <div class="mt-6 text-center">
                <a href="{{ route('chat.show', ['user' => $post->user->id]) }}"
                   class="mt-4 inline-block bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600">
                    Open Chat with {{ $post->user->name }}
                </a>
            </div>
        @endauth

        <!-- Comment Section -->
        <div class="mt-10 bg-gray-800 p-4 rounded-lg shadow">
            <h2 class="text-xl text-gray-100 mb-4">Comments</h2>

            <!-- Paginate Comments -->
            @foreach($post->comments->take(5) as $comment)
                <div class="border-b border-gray-700 pb-2 mb-2">
                    <p class="text-gray-300"><strong>{{ $comment->user->name }}</strong></p>
                    <p class="text-gray-300 mt-1">{{ $comment->content }}</p>
                    <p class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @endforeach

            <!-- Pagination for Comments -->
            @if ($post->comments->count() > 5)
                <div class="text-center mt-4">
                    <a href="{{ route('post.show', $post) }}" class="text-indigo-400 hover:underline">Load More Comments</a>
                </div>
            @endif

            @auth
                <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" class="w-full p-2 bg-gray-700 text-gray-300 rounded-lg" rows="3"
                              placeholder="Write a comment..."></textarea>
                    <button type="submit"
                            class="mt-2 bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600">Post Comment
                    </button>
                </form>
            @else
                <p class="text-gray-400 mt-2">You must be <a href="{{ route('login') }}" class="text-indigo-400 hover:underline">logged in</a> to comment.</p>
            @endauth
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Lightbox Script for Images -->
    <script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox-plus-jquery.min.js"></script>
@endpush
