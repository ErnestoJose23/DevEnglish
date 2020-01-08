<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Topic;
use App\Term;
use App\UserTopic;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function show(Topic $topic){
        if(UserTopic::subscribed($topic)){
            $terms = Term::where('topic_id', $topic->id)->get();
            $videos = Resource::where('topic_id', $topic->id)->where('type', 1)->get();
            $links = Resource::where('topic_id', $topic->id)->where('type', 2)->get();
            
            return view('information', compact('terms', 'videos', 'links'));
        }else return back();
    }
}
