<?php

namespace all4one\Http\Middleware;

use Closure;

class PatronMiddleware
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
      if(Auth::user()->user_type ==1)
        return $next($request);
      return redirect('/');
    }
}
