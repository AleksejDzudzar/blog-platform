@extends('layouts.app')

@section('title', 'Dodaj novi post')

@section('content')
    <h1 class="text-2xl font-bold text-white mb-6 text-center">New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" class="bg-gray-800 p-6 rounded-lg shadow-md max-w-xl mx-auto">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-300">Title</label>
            <input type="text" name="title" id="title" class="w-full border-gray-600 bg-gray-700 text-white rounded-md shadow-sm" value="{{ old('title') }}">
            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="slug" class="block text-gray-300">Slug (URL)</label>
            <input type="text" name="slug" id="slug" class="w-full border-gray-600 bg-gray-700 text-white rounded-md shadow-sm" value="{{ old('slug') }}">
            @error('slug') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-300">Category</label>
            <select name="category_id" id="category_id" class="w-full border-gray-600 bg-gray-700 text-white rounded-md shadow-sm">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="block text-gray-300">Content</label>
            <textarea name="content" id="content" rows="5" class="w-full border-gray-600 bg-gray-700 text-white rounded-md shadow-sm">{{ old('content') }}</textarea>
            @error('content') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="new_tags" class="block text-gray-300">Tags (separate with commas)</label>
            <input type="text" name="new_tags" id="new_tags" class="w-full border-gray-600 bg-gray-700 text-white rounded-md shadow-sm" value="{{ old('new_tags') }}">
            @error('new_tags') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
            Save
        </button>
    </form>
@endsection
