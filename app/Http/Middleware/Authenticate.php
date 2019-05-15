<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, $guard = null)
    {


         if(! Auth::check()){

            if($guard=="admin"){
                return redirect()->guest(route('admin.login'));
            }else{ 
                return redirect()->guest(routex('signIn'));
            }
        }else{
            if($guard=="admin" && Auth::User()->roll !=1){
                return redirect()->guest(routex('dashboard'));
            }
        }

        
        return $next($request);
    }

}
