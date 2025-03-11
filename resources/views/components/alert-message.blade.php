@props(['type'])

<div id="{{ $type }}-message" class="alert bg-{{ $type === 'success' ? 'green' : 'red' }}-600 text-white p-4 rounded-md shadow-md mb-4 opacity-100 transition-opacity duration-500 hidden">
    {{ session($type) }}
</div>
