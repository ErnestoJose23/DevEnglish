<?php

namespace App\Http\Controllers;

use Auth;
use App\topic;
use App\UserTopic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function Index(){
        $userTopic = new UserTopic();
        if(Auth::guest()){
            $topics = Topic::where('isActive', true)->get();
            $subscribed = 0;
            return view('topics', compact('subscribed','topics'));
        }
        $subscribed = $userTopic->subscriptions(Auth::user());
        $topicsSubscribed = [];
        foreach($subscribed as $i){
            $topicsSubscribed[] += $i->topic_id;
        }
        $topics = Topic::where('isActive', true) ->whereNotIn('id',$topicsSubscribed)->get();
        return view('topics', compact('subscribed','topics'));
    }
}
