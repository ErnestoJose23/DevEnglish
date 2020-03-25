<?php

namespace App\Http\Controllers;

use App\message;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;
use Auth;
use App\UserTopic;
use App\Chat;
use App\User;
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

        $user = User::where('id', $message->user_id)->first();
        $chat = Chat::where('id', $message->chat_id)->first();

        if($user->user_type_id == 3){
            $UserTopic = new UserTopic();
            $to = $UserTopic->assigned($chat->topic_id);
            $isTeacher = 1;
        }else{
            $to = $chat->user_id;
            $isTeacher = 0;
        }
        $chat_id_pusher = $chat->id;
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
    
        $data = ['from' => $from, 'to' => $to, 'isTeacher' => $isTeacher, 'chat_id_pusher' => $chat_id_pusher]; 
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
