<?php

namespace App\Http\Controllers\intranet;


use App\Post;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('intranet.forum.index', compact('posts'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $Post)
    {
        $post = Post::where('id', $Post->id)->with('comments.user')->first();
        return view('intranet.forum.show', compact('post'));
    }


    
    public function activate(Post $post){
        $post = Post::where('id', $post->id)->first();
        $post->isActive = 1;
        $post->save();
        return back()
            ->with('success','Post activado con exito.');
    }

    public function deactivate(Post $post){
        $post = Post::where('id', $post->id)->first();
        $post->isActive = 0;
        $post->save();
        return back()
            ->with('success','Post desactivado con exito.');
    }
}
