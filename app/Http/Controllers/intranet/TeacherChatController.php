<?php

namespace App\Http\Controllers\intranet;

use App\Chat;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherChatController extends Controller
{
    public function indexTopic(Topic $topic)
    {
        $chats = Chat::where('topic_id', $topic->id)->with('user')->get();
        return view('intranet.chat.index', compact('chats', 'topic'));
    }
}
