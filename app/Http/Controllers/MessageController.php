<?php

namespace App\Http\Controllers;

use App\message;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;
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
        $message->fill($request->all());
        if($request->hasfile('filename')){
            $message->image =  (new UploadMediaService)->uploadImageMessage($request);
        }
        $message->save();
        return $message;
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

        
    }
}
