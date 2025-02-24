@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-md">
        <div class="flex items-center space-x-4">
            <h1 class="text-3xl font-bold text-gray-100">{{ $user->name }}</h1>
            <img src="{{ asset('storage/' . ($user->avatar ?? 'default-avatar.png')) }}" alt="Avatar"
                 class="w-10 h-10 rounded-full">
        </div>

        <!-- Chat Messages -->
        <div id="chat-box" class="mt-6 bg-gray-800 p-4 rounded-lg overflow-auto space-y-4" style="max-height: 400px;">
            @foreach ($messages as $message)
                <div class="text-gray-300 mb-2">
                    <strong>{{ $message->user->name }}:</strong> {{ $message->message }}
                </div>
            @endforeach
        </div>

        <!-- Chat Input -->
        <div class="mt-4 flex items-center space-x-2">
            <textarea id="chat-input" class="w-full p-2 bg-gray-700 text-gray-300 rounded-lg resize-none" rows="3" placeholder="Type a message..."></textarea>
            <button id="send-message" class="bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-600 focus:outline-none">Send</button>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('/resources/js/app.js') }}"></script> <!-- Laravel Echo removed here -->

    <script>
        document.getElementById('send-message').addEventListener('click', function() {
            sendMessage();
        });

        // Send message when 'Enter' is pressed (without Shift)
        document.getElementById('chat-input').addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        function sendMessage() {
            let message = document.getElementById('chat-input').value;

            if (message.trim()) {
                axios.post('/chat/send', {
                    message: message,
                    user: {{ $user->id }} // Sending user data (not user_id)
                }, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(function(response) {
                    document.getElementById('chat-input').value = ''; // Clear the input field
                    // Reload the page to display the new message
                    window.location.reload();
                }).catch(function(error) {
                    console.error('Error sending message:', error);
                    alert("There was an error sending the message. Please try again.");
                });
            }
        }
    </script>
@endpush
