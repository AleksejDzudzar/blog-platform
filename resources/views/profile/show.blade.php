@extends('layouts.app')

@section('title', $user->name . "'s Profile")

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-md">
        <div class="flex justify-center items-center space-x-4">
            <!-- Profilna slika -->
            <img src="{{ asset('storage/' . ($user->avatar ?? 'default-avatar.png')) }}" alt="Avatar"
                 class="w-24 h-24 rounded-full border-4 border-indigo-600">

            <!-- Ime korisnika -->
            <div class="text-center text-gray-100">
                <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
                <p class="text-sm text-gray-400">Joined: {{ $user->created_at->format('d. M Y') }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-xl font-semibold text-gray-100">{{ $user->name }}'s Posts</h2>

            @if($posts->count())
                <div class="mt-4 space-y-4">
                    @foreach($posts as $post)
                        <div class="bg-gray-800 p-4 rounded-lg shadow-lg">
                            <a href="{{ route('posts.show', $post->slug) }}"
                               class="text-lg text-indigo-400 hover:text-indigo-600">{{ $post->title }}</a>
                            <p class="mt-2 text-gray-400">{{ Str::limit($post->content, 100) }}</p>
                            <span class="text-gray-500 text-sm">{{ $post->created_at->format('d. M Y') }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 mt-4">You haven't created any posts yet.</p>
            @endif
        </div>

        <!-- Social Media Links -->
        <div class="mt-6 text-center text-gray-300">
            <h2 class="text-xl font-semibold text-gray-100">{{ $user->name }}'s   Social Media</h2>

            <div class="mt-4 space-x-4">
                @if($user->facebook)
                    <a href="{{ $user->facebook }}" target="_blank" class="text-indigo-400 hover:text-indigo-600">
                        Facebook
                    </a>
                @endif
                @if($user->twitter)
                    <a href="{{ $user->twitter }}" target="_blank" class="text-indigo-400 hover:text-indigo-600">
                        Twitter
                    </a>
                @endif
                @if($user->linkedin)
                    <a href="{{ $user->linkedin }}" target="_blank" class="text-indigo-400 hover:text-indigo-600">
                        LinkedIn
                    </a>
                @endif
                @if($user->instagram)
                    <a href="{{ $user->instagram }}" target="_blank" class="text-indigo-400 hover:text-indigo-600">
                        Instagram
                    </a>
                @endif
            </div>
        </div>

    </div>
@endsection
