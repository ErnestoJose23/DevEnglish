<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use App\Comment;
use App\UserProblem;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\UploadMediaService;

class UserController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = User::where('id', Auth::id())->with('media')->first();
        return view('user.ajustes', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'. $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->hasfile('media')){
            $user->media_id = (new UploadMediaService)->updateImg($request);
        }
        $user->save();

        return back()
            ->with('success','Usuario modificado con exito.');
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request)
    {
        request()->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();
        return back()
            ->with('success','Contraseña modificada con exito.');


    }

    public function getProgreso( $id){
        $user = User::where('id', $id)->with('media')->first();
        $posts = Post::where('user_id', $id)->count();
        $comments = Comment::where('user_id', $id)->count();
        $userproblems = UserProblem::where('user_id', $id)->get();
        $pruebas = UserProblem::where('user_id', $id)->count();
        return view('progreso', compact('user', 'posts', 'comments', 'userproblems', 'pruebas'));
    }

}
