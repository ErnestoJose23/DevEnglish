<?php

namespace App\Http\Controllers\intranet;

use Auth;
use App\User;
use App\Post;
use App\Comment;
use App\UserProblem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('media')->get();
        return view('intranet.user.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('intranet.user.create');
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
        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('intranet.user.edit', compact('user'));
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
            'password' => 'sometimes|nullable|min:6',
            'password_confirmation' => 'sometimes|required_with:password|same:password',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password)
            $user->password = bcrypt($request->password);
        $user->save();

        return view('user.ajustes', compact('user'));
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
    
    public function activate(User $user){
        $user = User::findOrFail($user->id);
        $user->active = 1;
        $user->save();
        return back()
            ->with('success','Usuario activado con exito.');
    }

    public function deactivate(User $user){
        $user = User::findOrFail($user->id);
        $user->active = 0;
        $user->save();
        return back()
            ->with('success','Usuario desactivado con exito.');
    }

}
