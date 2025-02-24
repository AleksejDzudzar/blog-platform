@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Message dropdown -->
    @if (session('success'))
        <div id="success-message" class="alert alert-success bg-green-600 text-white p-4 rounded-md shadow-md mb-4 opacity-100 transition-opacity duration-500" style="display: none;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div id="error-message" class="alert alert-error bg-red-600 text-white p-4 rounded-md shadow-md mb-4 opacity-100 transition-opacity duration-500" style="display: none;">
            {{ session('error') }}
        </div>
    @endif

    <!-- Main section with latest posts -->
    <div class="mb-12">
        <h1 class="text-3xl font-semibold text-white mb-6">Latest Post's</h1>
        @auth
            <div class="mt-6 mb-6">
                <a href="{{ route('posts.create') }}"
                   class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                    New Post
                </a>
            </div>
        @endauth

        @if ($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
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
        @else
            <!-- Section for when there are no posts -->
            <div class="text-center bg-gray-800 p-8 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-gray-300">No articles available at the moment</h2>
                <p class="text-gray-500 mt-2">
                    Come back later or
                    <a href="{{ route('posts.create') }}" class="text-indigo-400 hover:underline">add a new article</a>.
                </p>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if ($posts->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="inline-flex items-center space-x-2">
                {{-- Previous Page Link --}}
                @if ($posts->onFirstPage())
                    <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">
                        &laquo; Prev
                    </span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-indigo-400 hover:text-indigo-600 bg-gray-700 rounded-md transition duration-300">
                        &laquo; Prev
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($posts->links()->elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $posts->currentPage())
                                <span class="px-4 py-2 text-sm font-medium text-indigo-400 bg-indigo-700 rounded-md">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-4 py-2 text-sm font-medium text-gray-400 hover:text-indigo-600 bg-gray-700 rounded-md transition duration-300">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-indigo-400 hover:text-indigo-600 bg-gray-700 rounded-md transition duration-300">
                        Next &raquo;
                    </a>
                @else
                    <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-gray-700 rounded-md cursor-not-allowed">
                        Next &raquo;
                    </span>
                @endif
            </div>
        </div>
    @endif

    <script>
        // Show messages when the page is loaded
        document.addEventListener("DOMContentLoaded", function() {
            let successMessage = document.getElementById("success-message");
            let errorMessage = document.getElementById("error-message");

            if (successMessage) {
                successMessage.style.display = "block";
                setTimeout(function() {
                    successMessage.style.opacity = 0;
                    setTimeout(function() {
                        successMessage.style.display = "none";
                    }, 500); // After the fade-out duration
                }, 5000); // Fade out after 5 seconds
            }

            if (errorMessage) {
                errorMessage.style.display = "block";
                setTimeout(function() {
                    errorMessage.style.opacity = 0;
                    setTimeout(function() {
                        errorMessage.style.display = "none";
                    }, 500); // After the fade-out duration
                }, 5000); // Fade out after 5 seconds
            }
        });
    </script>
@endsection
