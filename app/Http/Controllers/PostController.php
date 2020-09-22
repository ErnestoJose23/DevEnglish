<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('isActive', true)->with('user')->paginate('10');
        return view('forum.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->fill($request->all());

        if($request->hasfile('filename')){
            $image =  (new UploadMediaService)->uploadImages($request);
        }
        $post->isActive = true;
        $post->token = $request->token;
        $post->save();

        return redirect(route('forum.index'))->with('sucess', 'Post creado con exito');
    }

    public function show(Post $Post)
    {
        $post = $Post;
        $comments = Comment::where('post_id', $Post->id)->with('user')->paginate(10);
        return view('forum.post', compact('post', 'comments'));
    }
}
