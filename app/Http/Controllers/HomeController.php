<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\User;
use App\Problem;
use App\Chat;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function showIntranet(){
        $topics = Topic::count();
        $users = User::where('user_type_id', 3)->count();
        $teachers = User::where('user_type_id', 2)->count();
        $problems = Problem::count();
        $chats = Chat::count();
        $solved = Chat::where('solved', 1)->count();
        $percent_Unrounded = ($solved * 100) / $chats;
        $percent = round($percent_Unrounded, 2);
        return view('intranet.index', compact('topics', 'users', 'teachers', 'problems', 'percent', 'chats', 'solved'));
    }
}
