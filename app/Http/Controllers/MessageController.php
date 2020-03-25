<?php

namespace App\Http\Controllers;

use App\message;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;
use Auth;
use App\UserTopic;
use App\Chat;
use Pusher\Pusher;

class MessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = new Message();
        $message->user_id = Auth::id();
        $message->chat_id = $request->chat_id;
        $message->content = $request->content;
        $message->is_read = 0;
        $message->save();

        $UserTopic = new UserTopic();
        $chat = Chat::where('id', $message->chat_id)->first();
        
        $to = $UserTopic->assigned($chat->topic_id);
        $from = $message->user_id;
        
        $options = array(
            'cluster' => 'eu',
            'useTLS' => true
        );
        $pusher = new Pusher(
        '2552a5d3c8c00d550060',
        '86d2cbb00b79c9a25703',
        '967974',
        $options
        );
    
        $data = ['from' => $from, 'to' => $to]; 
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
