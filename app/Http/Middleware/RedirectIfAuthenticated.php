<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // return 
                if (Auth::user()->hasRole('admin')) {
                    return redirect('/dashboard'); // Replace '/admin' with your admin route
                } elseif (Auth::user()->hasRole('user')) {
                    return redirect('/user'); // Replace '/user' with your user route
                }else{
                    redirect(RouteServiceProvider::HOME);
                }
            }    
        }

        return $next($request);
    }
}
