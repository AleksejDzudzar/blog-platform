@props(['post'])

<div class="bg-gray-800 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
    <a href="{{ route('posts.show', $post->slug) }}" class="text-xl font-semibold text-indigo-400 hover:text-indigo-600 transition duration-300">
        {{ $post->title }}
    </a>
    <p class="text-gray-400 mt-3">{{ Str::limit($post->content, 150) }}</p>
    <div class="flex justify-between items-center mt-4 text-gray-500 text-sm">
        <span>{{ $post->created_at->format('d. M Y') }}</span>
    </div>
</div>
