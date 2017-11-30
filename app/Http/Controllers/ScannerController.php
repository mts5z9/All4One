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
    //Show Scanner Simulation page
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
    //Shows Scanner results of Scanning sim
    public function scanProgress(Request $data)
    {
      $businessID = DB::table('LOCATION')->where('locationID', $data['locationID'])->value('businessID');
      return view('admin.scannerProgress',['data'=>$data->all(),'businessID'=>$businessID]);
    }
    //Inserts new scans into the DB based on options chosen on the Scanner Sim page
    //if BadCards is checked 1 or 2 random array variable are changed to invalid card IDs
    public function newScan(Request $request)
    {

      $badCards = $request->badCards;
      $cards = DB::table('ACCOUNT')->pluck('cardID');
      $scanSuccess;
      $seconds = date('s') + 0.001;
      $date = date('Y-m-d H:i:') . $seconds . date('O');
      $data = $request->all();
      for($k=0;$k<$data['scanNumber'];$k++)
      {
          $cardArray[$k] = $data['cardID'];
      }
      if($badCards)
      {
        $rand1 = rand(0,$data['scanNumber']-1);
        $rand2 = rand(0,$data['scanNumber']-1);
        $cardArray[$rand1] = 'badcard'.rand(11111,99999);
        $cardArray[$rand2] = 'badcard'.rand(11111,99999);
      }

      $businessID = DB::table('LOCATION')->where('locationID', $data['locationID'])->value('businessID');

      for($i=0;$i<$data['scanNumber'];$i++)
      {
        foreach ($cards as $card) {
          if($card == $cardArray[$i]) {
            $scanSuccess[$i] = DB::table('SCAN')
              ->insert([
                        'cardID' => $cardArray[$i],
                        'timeStamp' => $date,
                        'locationID' => $data['locationID'],
                        'businessID' => $businessID,
                      ]);
            break;
          } else {
            $scanSuccess[$i] = false;
          }
        }
        $seconds = $seconds + 0.001;
        $date = date('Y-m-d H:i:') . $seconds . date('O');
      }
      $length = count($cardArray);
      return view('admin.scannerProgress',['scans'=>$scanSuccess,'cards'=>$cardArray,'length'=>$length]);

    }
}
