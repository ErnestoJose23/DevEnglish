<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Users;
use App\Post;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->fill($request->all());
        if($request->hasfile('filename')){
            $image =  (new UploadMediaService)->uploadImages($request);
            $comment->hasmedia = 1;
        }
        $comment->token = $request->token;
        $comment->save();

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
