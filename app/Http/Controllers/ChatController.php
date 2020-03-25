<?php

namespace App\Http\Controllers;

use App\Chat;
use App\UserTopic;
use App\User;
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
        
        $User = User::where('id', Auth::id())->first();
        if($User->user_type_id != 3){
            $chats = Chat::with('topic')->withCount(['messages' => function ($query) {
                $query->where('is_read', 'like', '0');
                $query->where('user_id', '!=', Auth::id());
            }])->get();
        }else{
            $chats = Chat::with('topic')->withCount(['messages' => function ($query) {
                $query->where('is_read', 'like', '0');
                $query->where('user_id', '!=', Auth::id());
            }])->where('user_id', Auth::id())->get();
        }

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
    public function show(Int $id)
    {
        $chat = Chat::where('id', $id)->with('user','messages.user')->first();
        foreach($chat->messages as $messages){
            if($messages->user_id != Auth::id()){
                $messages->is_read = 1;
                $messages->save();
            }
        }
        return view('chat.messages.index', compact('chat'));
        //return view('chat.show', compact('chat'));
    }

    public function solved(Chat $chat){
        $chat->solved = 1;
        $chat->save();
        return back()
            ->with('success','La consulta ha sido marcada como resuelta.');
    }
}