@extends('layouts.app')

@section('title', 'Registracija')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Registracija</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Ime</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md p-2"
                       value="{{ old('name') }}" required>
                @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

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

            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Potvrdi lozinku</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full border-gray-300 rounded-md p-2" required>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                Registruj se
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Već imate nalog?
            <a href="{{ route('login.form') }}" class="text-indigo-600 hover:underline">Prijavite se</a>
        </p>
    </div>
@endsection
