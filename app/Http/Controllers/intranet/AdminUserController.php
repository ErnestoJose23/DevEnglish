<?php

namespace App\Http\Controllers\intranet;

use Auth;
use App\User;
use App\Post;
use App\Comment;
use App\UserProblem;
use App\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UploadMediaService;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('user_type')->get();
        return view('intranet.user.index', compact('users'));
    }

    public function indexType(int $idtype){
        $users = User::where('user_type_id', $idtype)->with('user_type')->get();
        return view('intranet.user.index', compact('users'));
    }
    
    public function create()
    {
        $usertypes = UserType::all();
        return view('intranet.user.create', compact('usertypes'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_type_id = $request->user_type_id;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect(route('user.index'))->with('success', 'Monitor creado correctamente.');
    }

    public function show(User $user)
    {
        $edit = 0;
        $usertypes = UserType::all();
        return view('intranet.user.edit', compact('user', 'edit', 'usertypes'));
    }

    public function edit(User $user)
    {
        $edit = 1;
        $usertypes = UserType::all();
        return view('intranet.user.edit', compact('user', 'usertypes', 'edit'));
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

        return redirect(route('user.index'))->with('success', 'Usuario modificado con exito.');
    }

    public function setActive(User $user){
        $user->isActive = ($user->isActive == 0 ? 1 : 0);
        $user->save();
        return back()
            ->with('success','Usuario modificado con exito.');
    }
}
