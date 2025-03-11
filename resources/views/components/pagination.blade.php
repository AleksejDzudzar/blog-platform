@if ($posts instanceof \Illuminate\Pagination\LengthAwarePaginator && $posts->hasPages())
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
