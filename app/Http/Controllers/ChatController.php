<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NewMessage;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Prikazivanje chata sa korisnikom.
     */
    public function showChat(User $user)
    {
        return view('chat.index', compact('user'));
    }

    /**
     * Slanje poruke korisniku.
     */
    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'user_id' => Auth::id(),
            'content' => $request->message,
        ]);

        // Emitujemo event da frontend primi novu poruku
        broadcast(new NewMessage(auth()->user(), $message));

        return response()->json($message);
    }

    /**
     * Dohvatanje poslednjih 20 poruka.
     */
    public function getMessages()
    {
        return Message::with('user')->latest()->take(20)->get()->reverse()->values();
    }
}

