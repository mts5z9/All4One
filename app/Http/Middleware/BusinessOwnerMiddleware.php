<?php

namespace all4one\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BusinessOwnerMiddleware
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
        if(Auth::user()->role == 'Owner')
        {
            return $next($request);
        }else
          return redirect('/');
      }
    }
}
