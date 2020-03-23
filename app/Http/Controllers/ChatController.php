<?php

namespace App\Http\Controllers;

use App\Chat;
use App\UserTopic;
use App\Media;
use Auth;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;


class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userTopic = new UserTopic();
        $subscribed = $userTopic->subscriptionsList(Auth::user());
        $chats = Chat::where('user_id', Auth::id())->paginate(10);
        return view('chat.index', compact('chats', 'subscribed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chat = new Chat();
        $chat->fill($request->all());
        $chat->user_id = Auth::id();
        if($request->hasfile('filename')){
            $image =  (new UploadMediaService)->uploadImages($request);
        }
        $chat->token = $request->token;
        $chat->save();

        return redirect(route('consulta.index'))->with('success', 'Tu consulta ha sido enviada con exito al tutor.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        if($chat->user_id != Auth::id()) return redirect(route('consulta.index'));
        $chat = Chat::where('id', $chat->id)->with('user','messages.user')->first();
        return view('chat.show', compact('chat'));
    }

    public function solved(Chat $chat){
        $chat->solved = 1;
        $chat->save();
        return back()
            ->with('success','La consulta ha sido marcada como resuelta.');
    }
}