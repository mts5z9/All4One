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
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';
    public function getBusinessID ()
    {
      $businessId = DB::table('EMPLOYEE')
        ->where('emplid', Auth::user()->email)
        ->value('businessID');
      return $businessId;
    }
    public function getLocations()
    {
      $businessId = $this->getBusinessID();
      $locations = DB::table('LOCATION')
        ->where('businessID', $businessId)
        ->select('locationID','address1','address2','city','state','postalCode','email','phone')
        ->orderby('locationID', 'asc')->get();
      return $locations;
    }

    //Manage rewards

    public function showManageRewards()
    {
      $businessId = $this->getBusinessID();
      $rewards = DB::table('REWARD')
        ->where('businessID', $businessId)
        ->orderby('title', 'asc')->get();
      return view('business/manage-rewards',['rewards' => $rewards]);
    }
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
        ->join('EMPLOYEE', 'USERS.email', '=', 'EMPLOYEE.emplid')
        ->where('EMPLOYEE.businessID', $businessId)
        ->select('USERS.firstName','USERS.lastName','USERS.email','USERS.role','USERS.id')
        ->orderby('USERS.lastName', 'asc')->get(); //Need query for business employees
      return view('business/manage-employees',['employees' => $employees]);
    }
    public function showEditEmployee($id)
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
    public function editEmployee(Request $request, $id)
    {
      $email = DB::table('USERS')->where('id',$id)->value('email');
      $this->editEmployeeValidator($request->all(), $email)->validate();
      $this->editCreate($request->all(), $id);
      return redirect('/manageEmployees');
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
        return;
    }
    public function removeEmployee($id) {
      $emplid = DB::table('USERS')->where('id',$id)->value('email');
      DB::table('EMPLOYEE')
        ->where('emplid', $emplid)
        ->delete();
      DB::table('USERS')
        ->where('id', $id)
        ->delete();
      return redirect('/manageEmployees');
    }

    //Manage Locations

    public function showManageLocations()
    {
      $locations = $this->getLocations();
      return view('business/manage-locations',['locations' => $locations]);
    }
    public function showEditLocation($id)
    {
      $location = DB::table('LOCATION')
        ->where('locationID',$id)->first();
      return view('business.edit-location', ['location' => $location]);
    }
    public function editLocation(Request $request, $id)
    {
      $businessID = $this->getBusinessID();
      $this->validateLocation($request->all())->validate();
      DB::table('LOCATION')
       ->where('locationID', $id)
       ->update([
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

    //Manage Scanners

    public function showManageScanners()
    {
      $businessId = $this->getBusinessID();
      $scanners = DB::table('NFC_READER')
        ->join('READER_LOCATION', 'NFC_READER.serialNum', '=','READER_LOCATION.serialNum')
        ->join('LOCATION', 'READER_LOCATION.locationID', '=', 'LOCATION.locationID')
        ->where('LOCATION.businessID', $businessId)
        ->select('NFC_READER.*','READER_LOCATION.locationID')->get();
      $locations = $this->getLocations();
      return view('business/manage-scanners',['locations' => $locations, 'scanners' => $scanners]);
    }
    public function showAddScanner()
    {
      $businessId = $this->getBusinessID();
      $locations = $this->getLocations();
      return view('business.add-scanner',['locations' => $locations]);
    }
    public function addScanner(Request $request)
    {
      $businessId = $this->getBusinessID();
      $this->addScannerValidator($request->all())->validate();
      DB::table('NFC_READER')
        ->insert([
                  'serialNum' => $request['serialNum'],
                  'pin' => $request['pin'],
                  'model' => $request['model'],
                  'readerStatus' => 'actv',
        ]);
      DB::table('READER_LOCATION')
        ->insert([
                  'serialNum' => $request['serialNum'],
                  'locationID' => $request['locationID'],
                  'readerLocationStatus' => 'actv',
        ]);
        return redirect('/manageScanners');
    }
    public function addScannerValidator(array $data)
    {
      return Validator::make($data, [
        'serialNum' => 'string|max:20',
        'pin' => 'string|max:20',
        'model' => 'string|max:20',
      ]);
    }

    //Manage Scans

    public function showManageScans()
    {
      return view('business/manage-scans');
    }
}
