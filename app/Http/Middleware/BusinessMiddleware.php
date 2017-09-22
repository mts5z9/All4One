<?php

namespace all4one\Http\Middleware;

use Closure;

class BusinessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
       if(Auth::user()->user_type == 3)
         return $next($request);
       return redirect('/');
     }
}
