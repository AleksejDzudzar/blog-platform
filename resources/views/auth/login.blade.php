@extends('layouts.app')

@section('title', 'Prijava')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Prijava</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-md p-2"
                       value="{{ old('email') }}" required>
                @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700">Lozinka</label>
                <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-md p-2" required>
                @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">
                Prijavi se
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Nemate nalog?
            <a href="{{ route('register.form') }}" class="text-indigo-600 hover:underline">Registrujte se</a>
        </p>
    </div>
@endsection
