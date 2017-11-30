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
use Khill\Lavacharts\Lavacharts;

class BusinessEmployeeController extends BusinessController
{
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';
    //Shows Employee managment page
    public function show($status)
    {
      $businessId = $this->getBusinessID();
      $employees = DB::table('USERS')
        ->join('EMPLOYEE', 'USERS.email', '=', 'EMPLOYEE.emplid')
        ->where([
                ['EMPLOYEE.businessID','=',$businessId],
                ['USERS.status','=',$status],
                ])
        ->select('USERS.firstName','USERS.lastName','USERS.email','USERS.role','USERS.id','USERS.status')
        ->orderby('USERS.lastName', 'asc')->get(); //Need query for business employees
      return view('business/manage-employees',['employees' => $employees, 'status' => $status]);
    }
    //Edit individual employee data
    public function showEdit($id)
    {
      $businessId = $this->getBusinessID();
      $employee = DB::table('USERS')
        ->where('id', $id)->first();
      $locations = DB::table('LOCATION')
        ->where('businessID', $businessId)
        ->select('locationID','address1','address2','city','state','postalCode','email','phone')
        ->orderby('locationID', 'asc')->get(); //Need query for business employees
        return view('business.edit-employee',['locations' => $locations, 'employee'=>$employee]);
    }
    public function edit(Request $request, $id)
    {
      $email = DB::table('USERS')->where('id',$id)->value('email');
      $this->editEmployeeValidator($request->all(), $email)->validate();
      $this->editCreate($request->all(), $id);
      $status = DB::table('EMPLOYEE')->where('emplid',$email)->value('empStatus');
      $redirect = '/manageEmployees/'.$status;
      return redirect($redirect);
    }
    protected function editEmployeeValidator(array $data, $email)
    {
      if($data['email'] == $email){
        return Validator::make($data, [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'email' => 'required|string|email|max:255',
        ]);
      }else
          return Validator::make($data, [
              'firstName' => 'required|string|max:255',
              'lastName' => 'required|string|max:255',
              'phone' => 'required|string|max:10',
              'email' => 'required|string|email|max:255|unique:USERS',
          ]);
    }
    protected function editCreate(array $data, $id)
    {
      $location = DB::table('LOCATION')
        ->where('locationID',$data['location'])
        ->first();
      $status = 'actv';
      DB::table('USERS')
        ->where('id',$id)
        ->update([
                  'firstName'=>$data['firstName'],
                  'lastName'=>$data['lastName'],
                  'phone'=>$data['phone'],
                  'address1' => $location->address1,
                  'address2' => $location->address2,
                  'city' => $location->city,
                  'state' => $location->state,
                  'postalCode' => $location->postalCode,
                  'email' => $data['email'],
                ]);
        DB::table('EMPLOYEE')
          ->where('emplid',$data['email'])
          ->update([
                    'locationID'=>$data['location'],
                  ]);
        return;
    }
    //Change the status of an employee to either actv or inactv
    public function changeStatus($id) {
      $emp = DB::table('USERS')->where('id',$id)->first();

      if($emp->status == 'actv')
      {
        DB::table('EMPLOYEE')
          ->where('emplid', $emp->email)
          ->update(['empStatus'=>'inactv']);
        DB::table('USERS')
          ->where('id', $id)
          ->update(['status'=>'inactv']);
          return redirect('/manageEmployees/actv');
      } else if ($emp->status == 'inactv')
      {
        DB::table('EMPLOYEE')
          ->where('emplid', $emp->email)
          ->update(['empStatus'=>'actv']);
        DB::table('USERS')
          ->where('id', $id)
          ->update(['status'=>'actv']);
          return redirect('/manageEmployees/inactv');
      }
    }
}
