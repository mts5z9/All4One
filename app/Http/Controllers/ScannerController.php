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
      $scanSuccess;
      $seconds = date('s');
      $date = date('Y-m-d H:i:') . $seconds . date('O');
      $data = $request->all();
      $businessID = DB::table('LOCATION')->where('locationID', $data['locationID'])->value('businessID');
      for($i=0;$i<$data['scanNumber'];$i++)
      {
        $scanSuccess[$i] = DB::table('SCAN')
          ->insert([
                    'cardID' => $data['cardID'],
                    'timeStamp' => $date,
                    'locationID' => $data['locationID'],
                    'businessID' => $businessID,
                  ]);
        if($seconds == 60)
        {
          $seconds = 0;
        } else {
          $seconds++;
        }
        $date = date('Y-m-d H:i:') . $seconds . date('O');
      }
      $scanSuccess[0] = false;
      return view('admin.scannerProgress',['scans'=>$scanSuccess]);

    }
}
