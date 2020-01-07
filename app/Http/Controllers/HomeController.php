<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use App\User;
use App\Problem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function showIntranet(){
        $topics = Topic::count();
        $users = User::where('user_type_id', 3)->count();
        $teachers = User::where('user_type_id', 2)->count();
        $problems = Problem::count();
        return view('intranet.index', compact('topics', 'users', 'teachers', 'problems'));
    }
}
