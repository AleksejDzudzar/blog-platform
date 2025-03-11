@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Flash poruke -->
    @if (session('success'))
        <x-alert-message type="success" />
    @endif

    @if (session('error'))
        <x-alert-message type="error" />
    @endif

    <!-- Glavna sekcija sa najnovijim objavama -->
    <div class="mb-12">
        <h1 class="text-3xl font-semibold text-white mb-6">Latest Posts</h1>

        @auth
            <div class="mt-6 mb-6">
                <a href="{{ route('posts.create') }}" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                    New Post
                </a>
            </div>
        @endauth

        @if ($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        @else
            <div class="text-center bg-gray-800 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-300">No articles available at the moment</h2>
                <p class="text-gray-500 mt-2">
                    Come back later or
                    <a href="{{ route('posts.create') }}" class="text-indigo-400 hover:underline">add a new article</a>.
                </p>
            </div>
        @endif
    </div>

    <script>
        // Prikazivanje i sakrivanje poruka sa animacijom
        document.addEventListener("DOMContentLoaded", function() {
            ['success', 'error'].forEach(type => {
                let message = document.getElementById(type + "-message");
                if (message) {
                    message.style.display = "block";
                    setTimeout(() => {
                        message.style.opacity = 0;
                        setTimeout(() => {
                            message.style.display = "none";
                        }, 500);
                    }, 5000);
                }
            });
        });
    </script>
@endsection
