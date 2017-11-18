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
    //Business Account
    public function showEditAccount()
    {
      $businessID = $this->getBusinessID();
      $business = DB::table('BUSINESS')
                    ->where('businessID',$businessID)
                    ->first();
      return view('business.edit-business',['business' => $business]);
    }
    public function editAccount(Request $request)
    {
      $businessID = $this->getBusinessID();
      $email = DB::table('BUSINESS')->where('businessID',$businessID)->value('businessEmail');
      $this->accountValidator($request->all(),$email)->validate();
      DB::table('BUSINESS')
        ->where('businessID',$businessID)
        ->update([
                  'businessName' => $request['businessName'],
                  'category' => $request['category'],
                  'busDescr' => $request['busDescr'],
                  'phone' => $request['businessPhone'],
                  'businessEmail' => $request['businessEmail'],
                ]);

      return redirect('/portalDirect');
    }
    protected function accountValidator(array $data, $email)
    {
      if($data['businessEmail'] == $email) {
        return Validator::make($data, [
            //Business Info
            'businessName' => 'required|string|max:255',
            'category' => 'required|string|max:10',
            'busDescr' => 'required|string|max:255',
            'businessPhone' => 'required|string|max:10',
            'businessEmail' => 'required|string|email|max:255',
        ]);
      } else {
        return Validator::make($data, [
            //Business Info
            'businessName' => 'required|string|max:255',
            'category' => 'required|string|max:10',
            'busDescr' => 'required|string|max:255',
            'businessPhone' => 'required|string|max:10',
            'businessEmail' => 'required|string|email|max:255|unique:BUSINESS',
        ]);
      }


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
