<?php

namespace all4one\Http\Controllers;

use Illuminate\Http\Request;
use all4one\Http\Controllers\Controller;
use all4one\User;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
    }

    public function index()
    {
      $employee = User::all();
      return view('business.manage-employees', ['employees'=>$employees]);
    }

    public function create()
    {
      return View::make('business.add-employee');
    }

    public function store()
    {
      $user = new User;
      $user->firstName = Input::get('firstName');
      $user->lastName = Input::get('lastName');
      $user->email = Input::get('email');
      $user->password = Hash::make(Input::get('password'));

      $user->save();
      return Redirect::to('/manageEmployees');
    }

    public function edit($id)
    {
      $user = User::find($id);
      return view('auth.edit-account', ['user'=>$user]);
    }

    public function update($email)
    {
      $user = User::find($email);

      $user->firstName = Input::get('firstName');
      $user->lastName = Input::get('lastName');
      $user->email = Input::get('email');
      $user->password = Hash::make(Input::get('password'));

      $user->save();

      return Redirect::to('/manageEmployees');
    }

    public function destroy($email)
    {
      User::destroy($email);
      return Redirect::to('/manageEmployees');
    }
}
