@extends('layouts.app')

@section('title', 'Chat sa ' . $user->name)

@section('content')
    <div class="max-w-4xl mx-auto bg-gray-900 text-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold mb-4">Chat sa {{ $user->name }}</h2>

        <!-- Chat prozor -->
        <div class="h-96 overflow-y-auto border border-gray-700 p-4 rounded-lg bg-gray-800">
            @foreach($messages as $message)
                <div class="mb-3">
                    <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="p-3 rounded-lg max-w-xs {{ $message->sender_id == auth()->id() ? 'bg-indigo-600' : 'bg-gray-700' }}">
                            <strong>{{ $message->sender_id == auth()->id() ? 'Ti' : $user->name }}:</strong>
                            <p class="mt-1">{{ $message->message }}</p>
                            <span class="block text-sm text-gray-400 mt-1">{{ $message->created_at->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('chat.send') }}" method="POST" class="mt-4">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $user->id }}">

            <div class="flex">
                <input type="text" name="message" class="w-full p-2 rounded-l-md bg-gray-700 text-white border border-gray-600 focus:outline-none" placeholder="Unesi poruku..." required>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-r-md">Pošalji</button>
            </div>
        </form>
    </div>
@endsection
