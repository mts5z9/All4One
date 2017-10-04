<?php

namespace all4one\Http\Controllers\Auth;

use Illuminate\Http\Request;
use all4one\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin');
    }
    public function showLoginForm()
    {
      return view('auth.admin-login');
    }
    public function login()
    {
      $this->vaidate($request, [
        'email' => 'required|email',
        'password' => 'required|min:6'
      ]);
      if (Auth::gaurd('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->$remember)) {
        return redirect()->intended(route('admin.dashboard'));
      }
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
