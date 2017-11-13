<?php

namespace all4one\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

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
      if(Auth::user() == NULL)
      {
        return redirect('/');
      } else {
        if(Auth::user()->role == 'patron')
        {
            return $next($request);
        }else
          return redirect('/');
      }
    }
}
