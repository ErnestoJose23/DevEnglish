<?php

namespace App\Http\Controllers;

use App\topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function Index(){
        $topics = Topic::where('active','1')->get();
        return view('topics', compact('topics'));
    }
}
