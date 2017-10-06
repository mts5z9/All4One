<?php

namespace all4one\Http\Controllers;

use all4one\User;
use all4one\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
    }
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';
    public function editAccount(Request $request, $id)
    {
      $email = DB::table('USERS')->where('id',$id)->value('email');
      $this->updateValidator($request->all(), $email)->validate();
      $this->editCreate($request->all(), $id);
      return redirect('/portalDirect');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'city' => 'string',
            'state' => 'string|max:2',
            'postalCode' => 'string|max:5',
            'email' => 'required|string|email|max:255|unique:USERS',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    protected function updateValidator(array $data, $email)
    {
      if($data['email'] == $email){
        return Validator::make($data, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'address1' => 'required|string',
            'address2' => 'nullable|string',
            'city' => 'string',
            'state' => 'string|max:2',
            'postalCode' => 'string|max:5',
            'email' => 'required|string|email|max:255',
        ]);
      }else
          return Validator::make($data, [
              'firstName' => 'required|string|max:255',
              'lastName' => 'required|string|max:255',
              'phone' => 'required|string|max:10',
              'address1' => 'required|string',
              'address2' => 'nullable|string',
              'city' => 'string',
              'state' => 'string|max:2',
              'postalCode' => 'string|max:5',
              'email' => 'required|string|email|max:255|unique:USERS',
          ]);
    }
    protected function editCreate(array $data, $id)
    {
      DB::table('USERS')
        ->where('id',$id)
        ->update(['firstName'=>$data['firstName'],
                  'lastName'=>$data['lastName'],
                  'phone'=>$data['phone'],
                  'address1'=>$data['address1'],
                  'address2'=>$data['address2'],
                  'city'=>$data['city'],
                  'state'=>$data['state'],
                  'postalCode'=>$data['postalCode'],
                  'email' => $data['email'],
                ]);
        return;
    }

}
