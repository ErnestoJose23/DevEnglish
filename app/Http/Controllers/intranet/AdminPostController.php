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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    
    public function activate(Post $post){
        $post = Post::where('id', $post->id)->first();
        $post->active = 1;
        $post->save();
        return back()
            ->with('success','Post activado con exito.');
    }

    public function deactivate(Post $post){
        $post = Post::where('id', $post->id)->first();
        $post->active = 0;
        $post->save();
        return back()
            ->with('success','Post desactivado con exito.');
    }
}
