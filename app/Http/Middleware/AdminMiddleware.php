<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin' && Auth::user()->active != 0) {
                return $next($request);
            } elseif(Auth::user()->role == 'user' && Auth::user()->active != 0) {
                return redirect()->route('user.detail');
            } else {
                return redirect()->route('login')->with('errorLogin', 'Login Failed! You are banned Please contact to Taitbt for this problem');
            }   
        }
        

        return redirect()->route('login')->with('error', 'Login Failed! Try again');
        
    }

}
