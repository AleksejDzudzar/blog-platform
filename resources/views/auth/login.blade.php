@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4 text-white">Login</h2>

        @if (session('error'))
            <div class="bg-red-600 text-red-100 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

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

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                Login
            </button>
        </form>

        <p class="text-center text-gray-400 mt-4">
            Don't have an account?
            <a href="{{ route('register.form') }}" class="text-indigo-400 hover:underline">Register</a>
        </p>
    </div>
@endsection
