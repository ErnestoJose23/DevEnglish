<?php

namespace App\Http\Controllers;

use App\message;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;

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
    }
}
