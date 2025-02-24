<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(User $user)
    {
        $authUserId = auth()->id();

        $messages = Message::where(function ($query) use ($authUserId, $user) {
            $query->where('sender_id', $authUserId)
                ->where('receiver_id', $user->id);
        })
            ->orWhere(function ($query) use ($authUserId, $user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', $authUserId);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('chat.index', compact('user', 'messages'));
    }
    public function conversations()
    {
        $authUserId = auth()->id();

        $users = User::whereHas('sentMessages', function ($query) use ($authUserId) {
            $query->where('receiver_id', $authUserId);
        })->orWhereHas('receivedMessages', function ($query) use ($authUserId) {
            $query->where('sender_id', $authUserId);
        })->distinct()->get();

        return view('chat.conversations', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return redirect()->back();
    }

}
