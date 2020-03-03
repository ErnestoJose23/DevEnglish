<?php

namespace App\Http\Controllers\intranet;

use App\Chat;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with('user')->with('topic')->get();
        return view('intranet.chat.index', compact('chats'));
    }

    public function show(Chat $chat)
    {
        $user = Auth::user();
        $chat = Chat::where('id', $chat->id)->with('user','messages.user')->first();
        return view('intranet.chat.show', compact('chat', 'user'));
    }

    public function destroy(Chat $chat)
    {
        $chat->delete();
        return back()->with('success', 'Elemento borrado correctamente.');
    }
}
