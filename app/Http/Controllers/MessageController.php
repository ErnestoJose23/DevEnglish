<?php

namespace App\Http\Controllers;

use App\message;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;
use Auth;
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

/*
        $options = array(
            'cluster' => 'ap2',
        );

        $pusher = new Pusher(
            env(key: 'PUSHER_APP_HEY'),
            env(key: 'PUSHER_APP_SECRET'),
            env(key: 'PUSHER_APP_ID',
            $options)
        );
        $data = ['from' =>$message->user_id, 'to' => $message->chat_id];
        $pusher->trigger('my-channel', 'my-event', $data);

  */      
    }
}
