<?php

namespace App\Http\Controllers\intranet;

use Auth;
use App\UserTopic;
use App\User;
use App\Topic;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachertopics = UserTopic::where('user_id', Auth::id())->pluck('topic_id');
        $topics = Topic::wherein('id', $teachertopics)->with('media', 'subscriptions.user')->get();
        return view('intranet.topic.index', compact('topics'));
    }
}