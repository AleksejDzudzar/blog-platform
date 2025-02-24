@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto bg-gray-800 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-white">My conversations</h2>

        @if($users->count() > 0)
            <ul>
                @foreach($users as $user)
                    <li class="flex items-center justify-between mb-4 p-4 border-b border-gray-700 rounded-lg hover:bg-gray-700">
                        <a href="{{ route('chat.show', $user->id) }}" class="flex items-center space-x-4 text-blue-400 hover:underline">
                            <!-- Avatar -->
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}'s Avatar" class="w-12 h-12 rounded-full border-2 border-gray-600">
                            <span class="font-semibold text-lg text-white">{{ $user->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500 text-center">You don't have any conversations.</p>
        @endif
    </div>
@endsection
