<?php

namespace App\Http\Controllers;

use Auth;
use App\topic;
use App\UserTopic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function Index(){
        $subscribed = UserTopic::where('user_id', Auth::id())->with('topic')->get();
        $topicsSubscribed = [];
        foreach($subscribed as $i){
            $topicsSubscribed[] += $i->topic_id;
        }
        $topics = Topic::where('active', true) ->whereNotIn('id',$topicsSubscribed)->get();
        return view('topics', compact('subscribed','topics'));
    }
}
