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


class BusinessLocationController extends BusinessController
{

    public function show($status)
    {
      $locations = $this->getLocations($status);
      return view('business/manage-locations',['locations' => $locations,'status'=>$status]);
    }
    public function showEdit($id)
    {
      $location = DB::table('LOCATION')
        ->where('locationID',$id)->first();
      return view('business.edit-location', ['location' => $location]);
    }
    public function edit(Request $request, $id)
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
               ]);
       $status = DB::table('LOCATION')->where('locationID',$id)->value('locationStatus');
       $redirect = '/manageLocations/'.$status;
       return redirect($redirect);
    }
    public function showCreate()
    {
      return view('business.add-location');
    }
    public function create(Request $request)
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
      return redirect('/manageLocations/actv');

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
    public function changeStatus($id) {
      $location = DB::table('LOCATION')->where('locationID',$id)->first();
      if($location->locationStatus == 'actv')
      {
        DB::table('LOCATION')
        ->where('locationID', $id)
        ->update(['locationStatus'=>'inactv']);
          return redirect('/manageLocations/actv');
      } else if ($location->locationStatus == 'inactv')
      {
        DB::table('LOCATION')
        ->where('locationID', $id)
        ->update(['locationStatus'=>'actv']);
          return redirect('/manageLocations/inactv');
      }
    }
}
