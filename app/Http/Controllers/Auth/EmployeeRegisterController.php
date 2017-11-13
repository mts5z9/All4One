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

class EmployeeRegisterController extends Controller
{
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';

    public function show()
    {
      $businessId = DB::table('EMPLOYEE')
        ->where('emplid', Auth::user()->email)
        ->value('businessID');
      $locations = DB::table('LOCATION')
        ->where('businessID', $businessId)
        ->select('locationID','address1','address2','city','state','postalCode','email','phone')
        ->orderby('locationID', 'asc')->get(); //Need query for business employees

        return view('auth.employee-register',['locations' => $locations]);
    }
    public function registerEmployee(Request $request)
    {
        $this->validator($request->all())->validate();
        $this->create($request->all());
        return redirect('/manageEmployees');
    }
    public function modifyRole($id, $userRole) {
      if($userRole == 'employee') {
        $userRole = 'bAdmin';
      }else if($userRole == 'bAdmin') {
        $userRole = 'employee';
      }
      DB::table('USERS')
        ->where('id', $id)
        ->update(['role' => $userRole]);
        $status = DB::table('USERS')->where('id',$id)->value('status');
        $redirect = '/manageEmployees/'.$status;
        return redirect($redirect);
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'email' => 'required|string|email|max:255|unique:USERS',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    protected function create(array $data)
    {
        $location = DB::table('LOCATION')
          ->where('locationID',$data['location'])
          ->first();
        $role = 'employee';
        $status = 'actv';
        $data['email'] = strtolower($data['email']);

        $user = User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'role' => $role,
            'phone' => $data['phone'],
            'address1' => $location->address1,
            'address2' => $location->address2,
            'city' => $location->city,
            'state' => $location->state,
            'postalCode' => $location->postalCode,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'status' => $status,
        ]);

        DB::table("EMPLOYEE")
          ->insert([
              'businessID' => $location->businessID,
              'emplid' => $data['email'],
              'empStatus' => 'actv',
              'locationID' => $location->locationID,
        ]);

        return $user;
    }

}
