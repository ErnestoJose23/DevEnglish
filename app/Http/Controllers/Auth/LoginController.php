<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function validateLogin(Request $request)
    {
        $credentials = request()->validate([
            'email' => 'email|required|string',
            'password' => 'required|string'
        ]);
        if(Auth::attempt($credentials)){
            if(!Auth::user()->activo()){ //Esto hacerlo con la fecha de baneo es menor que now
                Auth::logout();
                return back()->with('error', 'Cuenta bloqueada.'); // Meter aqui hasta cuando
            }
            if(Auth::user()->isAdmin())
                return redirect(route('dashboard'));
            elseif(Auth::user()->isTeacher())
                return redirect(route('teachertopic.index'));
            else
                return redirect(route('inicio'));
        }else
            return back()->with('error', 'Credenciales incorrectos.');
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect(route('inicio'));
    }
}
