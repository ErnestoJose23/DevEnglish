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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('user_type')->get();
        return view('intranet.user.index', compact('users'));
    }

    public function indexType(int $idtype){
        $users = User::where('user_type_id', $idtype)->with('user_type')->get();
        return view('intranet.user.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usertypes = UserType::all();
        return view('intranet.user.create', compact('usertypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->id == Auth::id())
            return redirect(route('user.index'))->with('error', 'No puedes borrar tu propia cuenta.');
        else{
            $user->email = $user->email . ' BORRADO ' . date("Y-m-d H:i:s");
            $user->save();
            $user->delete();
        }

        return redirect(route('user.index'))->with('success', 'Monitor borrado correctamente.');
    }
    
    public function setActive(User $user){
        $user->isActive = ($user->isActive == 0 ? 1 : 0);
        $user->save();
        return back()
            ->with('success','Usuario modificado con exito.');
    }

    public function activate(User $user){
        $user = User::findOrFail($user->id);
        $user->isActive = 1;
        $user->save();
        return back()
            ->with('success','Usuario activado con exito.');
    }

    public function deactivate(User $user){
        $user = User::findOrFail($user->id);
        $user->isActive = 0;
        $user->save();
        return back()
            ->with('success','Usuario desactivado con exito.');
    }
}
