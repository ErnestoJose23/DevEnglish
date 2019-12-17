<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!Auth::Check())
            return redirect('login');
        $user = Auth::user();

        if($user->isAdmin() || $user->isTeacher())
            return $next($request);
        
        return redirect('/');
    }
}
