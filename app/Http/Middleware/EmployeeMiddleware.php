<?php

namespace all4one\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
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
      $userRole = Auth::user()->role;
      if($userRole == 'employee'|| $userRole == 'bAdmin'|| $userRole == 'Owner')
      {
          return $next($request);
      }else
        return redirect('/');
    }
}
