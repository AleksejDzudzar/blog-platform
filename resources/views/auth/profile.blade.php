@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl mx-auto mt-6 px-6 py-4 bg-gray-800 shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold text-white mb-4">Edit Your Profile</h1>

        @if (session('success'))
            <div class="mb-4 text-green-400">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-300">Name</label>
                <input type="text" name="name" id="name" class="w-full p-2 border border-gray-600 bg-gray-700 text-white rounded-lg" value="{{ old('name', $user->name) }}">
                @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-300">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-600 bg-gray-700 text-white rounded-lg" value="{{ old('email', $user->email) }}">
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="avatar" class="block text-gray-300">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="w-full p-2 border border-gray-600 bg-gray-700 text-white rounded-lg">
                @error('avatar')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                @if ($user->avatar)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full border-2 border-gray-600">
                    </div>
                @endif
            </div>

            <div>
                <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition duration-300">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
@endsection
