<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use App\Comment;
use App\UserProblem;
use App\UserTopic;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\UploadMediaService;

class UserController extends Controller
{
    public function edit(User $user)
    {
        if(Auth::id() != $user->id) $user = Auth::user();
        return view('user.ajustes', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if($request->name != $user->name){
            $request->validate([
                'name' => 'required|unique:users,name,'. $user->id,
            ]);
            $user->name = $request->name;
        }
        if($request->email != $user->email){
            $request->validate([
                'email' => 'required|unique:users,email,'. $user->id
            ]);
            $user->email = $request->email;
        }
        
        if($request->hasfile('avatar')){
            $user->avatar = (new UploadMediaService)->updateImg($request);
        }

        $user->save();

        return back()
            ->with('success','Usuario modificado con exito.');
    }

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

    public function show(User $user){
        $userTopic = new UserTopic();
        $subscriptions = $userTopic->subscriptions($user);
        $posts = Post::where('user_id', $user->id)->where('isActive', 1)->get();
        $comments = Comment::where('user_id', $user->id)->count();
        $userproblems = UserProblem::where('user_id', $user->id)->with('topic')->with('problem')->get();
        
        return view('progreso', compact('user', 'posts', 'comments', 'userproblems', 'subscriptions'));
    }
}
