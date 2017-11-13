<?php

namespace all4one\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PortalMiddleware
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
        if(Auth::guest()){
          return redirect('/');
        }else if (Auth::user()) {
          if(Auth::user()->role == 'employee'){
            return redirect('/manageScans');
          }else if(Auth::user()->role == 'patron'){
            return redirect('/rewards');
          }else if(Auth::user()->role == 'admin'){
            return redirect('/scanner');
          }else if(Auth::user()->role == 'Owner'){
            return redirect('/manageRewards/actv');
          }else if(Auth::user()->role == 'bAdmin'){
            return redirect('/manageRewards/actv');
          }
        } else {
          return redirect('/');
        }
      }
    }
}
