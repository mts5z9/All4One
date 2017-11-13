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
    public function getLocations($status)
    {
      $businessId = $this->getBusinessID();
      $locations = DB::table('LOCATION')
        ->where([
                ['businessID', $businessId],
                ['locationStatus',$status],
               ])
        ->select('locationID','address1','address2','city','state','postalCode','email','phone','locationStatus')
        ->orderby('locationID', 'asc')->get();
      return $locations;
    }
    public function getRewards()
    {
      $businessID = $this->getBusinessID();
      $rewards = DB::table('REWARD')
                  ->where([
                          ['businessID', $businessID],
                          ['rewardStatus','actv'],
                         ])
                  ->orderBy('rewardID','asc')->get();
      return $rewards;
    }
    //Manage Scans

    public function showManageScans()
    {
      $businessId = $this->getBusinessID();
      $scans = DB::table('SCAN')
        ->join('ACCOUNT','SCAN.cardID','=','ACCOUNT.cardID')
        ->where('SCAN.businessID', $businessId)
        ->select('SCAN.*','ACCOUNT.patronEmail')
        ->orderby('timeStamp','dec')->get();
      return view('business/manage-scans',['scans' => $scans]);
    }

}
