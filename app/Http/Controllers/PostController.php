<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('active', true)->with('user')->paginate('10');
        return view('forum.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->fill($request->all());

        if($request->hasfile('filename')){
            $image =  (new UploadMediaService)->uploadImages($request);
        }
        $post->active = true;
        $post->date = date('Y-m-d H:i:s');
        $post->token = $request->token;
        $post->save();

        return redirect(route('forum.index'))->with('sucess', 'Post creado con exito');
    }

    /**
     * Display the specified resource.00000000
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $Post)
    {
        $post = Post::where('id', $Post->id)->with('comments.user.media')->first();
        return view('forum.post', compact('post'));
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

}
