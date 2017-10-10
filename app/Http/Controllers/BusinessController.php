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

class BusinessController extends Controller
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
    }
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';
    public function getBusinessID ()
    {
      $businessId = DB::table('EMPLOYEE')
        ->where('emplid', Auth::user()->email)
        ->value('businessID');
      return $businessId;
    }
    //Manage rewards
    public function showManageRewards()
    {
      $rewards = DB::table('REWARD')
        ->orderby('title', 'asc')->get();
      return view('business/manage-rewards',['rewards' => $rewards]);
    }
    //Create Reward
    public function showCreateReward()
    {
      return view('business.add-reward');
    }
    public function createReward(Request $request)
    {
      $businessID = $this->getBusinessID();
      $rewardStatus = 'actv';
      $this->validateReward($request->all())->validate();
      DB::table('REWARD')
        ->insert([
                  'title' => $request['title'],
                  'descr' => $request['descr'],
                  'pointsNeeded' => $request['pointsNeeded'],
                  'beginDate' => $request['beginDate'],
                  'endDate' => $request['endDate'],
                  'businessID' => $businessID,
                  'rewardStatus' => $rewardStatus,
                ]);
      return redirect('/manageRewards');

    }
    public function validateReward(array $data)
    {
      return Validator::make($data, [
        'title' => 'required|string|max:255',
        'descr' => 'required|string|max:255',
        'pointsNeeded' => 'required|string|max:5',
        'beginDate' => 'required',
        'endDate' => 'required',
      ]);
    }
    //Manage Employees
    public function showManageEmployees()
    {
      $businessId = $this->getBusinessID();
      $employees = DB::table('USERS')
        ->where('role', '=', 'employee')
        ->orwhere('role', '=', 'bAdmin')
        ->select('firstName','lastName','email','role','id')
        ->orderby('lastName', 'asc')->get(); //Need query for business employees
      return view('business/manage-employees',['employees' => $employees]);
    }
    public function showEditEmployee($id)
    {
      $employee = DB::table('USERS')
        ->where('id', $id)->first();
      return view('business.edit-employee', ['employee' => $employee]);
    }
    //Manage Locations
    public function showManageLocations()
    {
      $businessId = $this->getBusinessID();

      $locations = DB::table('LOCATION')
        ->where('businessID', $businessId)
        ->select('locationID','address1','address2','city','state','postalCode','email','phone')
        ->orderby('locationID', 'asc')->get(); //Need query for business employees
      return view('business/manage-locations',['locations' => $locations]);
    }
    //Create Location
    public function showCreateLocation()
    {
      return view('business.add-location');
    }
    public function createLocation(Request $request)
    {
      $businessID = $this->getBusinessID();
      $this->validateLocation($request->all())->validate();
      DB::table('LOCATION')
        ->insert([
                  'address1' => $request['address1'],
                  'address2' => $request['address2'],
                  'city' => $request['city'],
                  'state' => $request['state'],
                  'postalCode' => $request['postalCode'],
                  'email' => $request['email'],
                  'phone' => $request['phone'],
                  'businessID' => $businessID,
                  'locationStatus' => 'actv',
                ]);
      return redirect('/manageLocations');

    }
    public function validateLocation(array $data)
    {
      return Validator::make($data, [
        'address1' => 'required|string',
        'address2' => 'nullable|string',
        'city' => 'string',
        'state' => 'string|max:2',
        'postalCode' => 'string|max:5',
        'email' => 'required|string|email|max:255',
        'phone' => 'required|string|max:10',
      ]);
    }
    //Manage Scans
    public function showManageScans()
    {
      return view('business/manage-scans');
    }
}
