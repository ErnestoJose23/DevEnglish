<?php

namespace App\Http\Controllers\intranet;


use App\Post;
use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('intranet.forum.index', compact('posts'));
    }

    public function show(Post $Post)
    {
        $post = Post::where('id', $Post->id)->with('comments.user')->first();
        return view('intranet.forum.show', compact('post'));
    }

    public function edit(Post $post){
        $post->isActive = ($post->isActive == 0 ? 1 : 0);
        $post->save();
        return back()
            ->with('success','Post modificado con exito.');
    }
}
