<?php

namespace all4one\Http\Controllers\Auth;

use all4one\User;
use all4one\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Support\Facades\DB;

class BusinessRegisterController extends Controller
{
  use RedirectsUsers;
  protected $redirectTo = '/portalDirect';

    public function show()
    {
        return view('auth.business-register');
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $businessId = $this->createBusiness($request->all());
        $this->linkBusiness($businessId,$request->all());
        $this->guard()->login($user);
        return redirect('/portalDirect');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    protected function registered(Request $request, $user)
    {
        //
    }

    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            //Account Info
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
            //Business Info
            'businessName' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'busDescr' => 'required|string|max:255',
            'businessPhone' => 'required|string|max:10',
            'businessAddress1' => 'required|string',
            'businessAddress2' => 'nullable|string',
            'businessCity' => 'string',
            'businessState' => 'string|max:2',
            'businessPostalCode' => 'string|max:5',
            'businessEmail' => 'required|string|email|max:255|unique:BUSINESS',
        ]);

        return $validator;
    }
    protected function create(array $data)
    {
        $role = "Owner";
        $status = "actv";
        $data['email'] = strtolower($data['email']);
        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'role' => $role,
            'phone' => $data['phone'],
            'address1' => $data['address1'],
            'address2' => $data['address2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'postalCode' => $data['postalCode'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => $status,
        ]);
    }

    protected function createBusiness(array $data)
    {
      $data['businessEmail'] = strtolower($data['businessEmail']);
      $businessId = DB::table('BUSINESS')
        ->insertGetId(
                [
                  'businessName' => $data['businessName'],
                  'category' => $data['category'],
                  'busDescr' => $data['busDescr'],
                  'businessEmail' => $data['businessEmail'],
                  'phone' => $data['businessPhone'],
                ],'businessID');
      return $businessId;
    }

    protected function linkBusiness(int $businessId,array $data)
    {
      $data['email'] = strtolower($data['email']);
      $data['businessEmail'] = strtolower($data['businessEmail']);
      $locationId = DB::table("LOCATION")
        ->insertGetId([
          'businessID' => $businessId,
          'address1' => $data['businessAddress1'],
          'address2' => $data['businessAddress2'],
          'city' => $data['businessCity'],
          'state' => $data['businessState'],
          'postalCode' => $data['businessPostalCode'],
          'email' => $data['businessEmail'],
          'phone' => $data['businessPhone'],
          'locationStatus' => 'actv',
        ],'locationID');

      DB::table("EMPLOYEE")
        ->insert([
            'businessID' => $businessId,
            'emplid' => $data['email'],
            'empStatus' => 'actv',
            'locationID' => $locationId,
        ]);
        return;
    }
}
