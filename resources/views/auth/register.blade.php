@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4 text-white">Register</h2>

        @if (session('error'))
            <div class="bg-red-600 text-red-100 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-300">Name</label>
                <input type="text" name="name" id="name" class="w-full border-gray-700 rounded-md p-2 bg-gray-700 text-white"
                       value="{{ old('name') }}" required>
                @error('name')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-300">Email</label>
                <input type="email" name="email" id="email" class="w-full border-gray-700 rounded-md p-2 bg-gray-700 text-white"
                       value="{{ old('email') }}" required>
                @error('email')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-300">Password</label>
                <input type="password" name="password" id="password" class="w-full border-gray-700 rounded-md p-2 bg-gray-700 text-white" required>
                @error('password')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-300">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full border-gray-700 rounded-md p-2 bg-gray-700 text-white" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                Register
            </button>
        </form>

        <p class="text-center text-gray-400 mt-4">
            Already have an account?
            <a href="{{ route('login.form') }}" class="text-indigo-400 hover:underline">Login</a>
        </p>
    </div>
@endsection
