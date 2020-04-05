<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Users;
use App\Post;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;

class CommentController extends Controller
{
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
    public function destroy(Comment $comment)
    {
        foreach($comment->images() as $image){
            $filename = public_path().'/uploads/media/'.$image;
            \File::delete($filename);
        }
        $comment->delete();
        return back();
    }
}
