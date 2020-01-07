<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\User;
use App\UserTopic;

class SendEmail 
{
    function sendMail(int $id, String $topic, String $resource, int $type, int $topic_id){
        $data = array(
            'resource' => $resource,
            'topic' => $topic,
            'id_resource' => $id,
            'resource_type' => $type
        );
        
        $emails = UserTopic::where('topic_id', $topic_id)->with('user')->get();
        $emailto = [];
        foreach($emails as $email){
            array_push($emailto, $email->user->email);
        }

        Mail::to($emailto)->send( new SendMail($data));
        
        return true;
    }

    function contactUs($request){
        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'contact' => 1
        );
        Mail::to('devenglishinfo@gmail.com')->send( new ContactMail($data));

        return true;
    }
}
