<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BlockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $user = Auth::user();
        if($user->block != null){
             return redirect()->route('blockpage');
        }
        // return redirect()->route('home');
        return $next($request);
    }
}
