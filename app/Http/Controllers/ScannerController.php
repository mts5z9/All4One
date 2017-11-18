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

class ScannerController extends Controller
{
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';

    public function showScanner()
    {
      $locations = DB::table('LOCATION')
        ->join('BUSINESS','LOCATION.businessID','=','BUSINESS.businessID')
        ->where('LOCATION.locationStatus', 'actv')
        ->select('LOCATION.*','BUSINESS.businessName')
        ->orderby('LOCATION.locationID','asc')->get();
      $cards = DB::table('ACCOUNT')
        ->where('accountStatus', 'actv')
        ->orderby('cardID', 'asc')->get();

      return view('admin.scanner',['cards' => $cards, 'locations' => $locations]);
    }

    public function scanProgress(Request $data)
    {
      $businessID = DB::table('LOCATION')->where('locationID', $data['locationID'])->value('businessID');
      return view('admin.scannerProgress',['data'=>$data->all(),'businessID'=>$businessID]);
    }

    public function newScan(Request $request)
    {
      $businessID = DB::table('LOCATION')->where('locationID', $data['locationID'])->value('businessID');
      $data = $request->all();
      $result = DB::table('SCAN')
        ->insert([
                  'cardID' => $data['cardID'],
                  'timeStamp' => date('Y-m-d H:i:sO'),
                  'locationID' => $data['locationID'],
                  'businessID' => $businessID,
                ]);
      return $result;
    }
}
