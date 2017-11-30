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
use Illuminate\Support\Facades\Mail;
use all4one\Mail\rewardUsed;


class BusinessScanController extends BusinessController
{
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';
    // Shows scans for business and can remove scans
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
    //Removes a selected scan
    public function removeScan($id, $timeStamp)
    {
      $cond = DB::table('SCAN')
        ->where('cardID',$id)
        ->where('timeStamp',$timeStamp)
        ->delete();
      return redirect('/manageScans');
    }
    //Give a customer a scan point
    public function addScan($id)
    {
      $businessId = $this->getBusinessID();
      $locationId = DB::table('EMPLOYEE')
        ->where('emplid',Auth::user()->email)
        ->value('locationID');
      $cardID = DB::table('ACCOUNT')
        ->where('patronEmail',$id)
        ->value('cardID');
      DB::table('SCAN')
        ->insert([
                  'cardID' => $cardID,
                  'timeStamp' => date('Y-m-d H:i:sO'),
                  'locationID' => $locationId,
                  'businessID' => $businessId,
                ]);
      return redirect('/managePatrons');
    }
    //Shows page of customers who have scans at the business
    public function showManagePatrons()
    {
      $businessId = $this->getBusinessID();
      $patrons = DB::table('USERS')
        ->join('SCAN_TOTAL','SCAN_TOTAL.patronID',"USERS.email")
        ->where('SCAN_TOTAL.businessID',$businessId)
        ->groupBy('USERS.email')
        ->select('USERS.email','USERS.firstName','USERS.lastName')->get();
      foreach ($patrons as $patron)
      {
        $patron->total = DB::table('SCAN_TOTAL')
          ->where([
                  ['patronID', $patron->email],
                  ['businessID', $businessId],
                  ])
          ->latest('dateTime')
          ->value('total');
      }

      return view('business/manage-patrons',['patrons'=>$patrons]);
    }
    //shows Rewards the customer has claimed
    public function showPatronRewards($id)
    {
      $cardID = DB::table('ACCOUNT')->where('patronEmail','=',$id)->value('cardID');
      $rewards = DB::table('CLAIMED_REWARD')
                  ->join('REWARD','REWARD.rewardID','=','CLAIMED_REWARD.rewardID')
                  ->join('BUSINESS','BUSINESS.businessID','=','REWARD.businessID')
                  ->where('CLAIMED_REWARD.patronID',$id)
                  ->where('CLAIMED_REWARD.status','new')
                  ->get();
      return view('business.available-rewards',['rewards'=>$rewards]);
    }
    //Use a claimed reward
    public function useReward($id,$email,$timeStamp)
    {
      $query = DB::table('CLAIMED_REWARD')
        ->where([
                ['rewardID',$id],
                ['status', 'new'],
                ['patronID', $email],
                ['claimTimeStamp', $timeStamp],
              ])
        ->update(['status'=>'used']);

      if($query)
      {
        $reward = DB::table('REWARD')
                    ->join('BUSINESS','BUSINESS.businessID','=','REWARD.businessID')
                    ->where('REWARD.rewardID',$id)
                    ->select('REWARD.*','BUSINESS.businessName')->first();
        $name = DB::table('USERS')->where('email',$email)->select('firstName','lastName')->first();
        $rewardInfo = [
          'name' => $name->firstName." ".$name->lastName,
          'title' => $reward->title,
          'descr' => $reward->descr,
          'businessName' => $reward->businessName
        ];
        Mail::to($email)->send(new rewardUsed($rewardInfo));
      }
      return redirect('/customerRewards/'.$email);
    }
    //Search customers by email
    public function searchManagePatrons(Request $request)
    {
      $data = $request->all();
      $search = '%' . $data['search'] . '%';
      $businessId = $this->getBusinessID();
      $patrons = DB::table('USERS')
        ->join('SCAN_TOTAL','SCAN_TOTAL.patronID',"USERS.email")
        ->where('SCAN_TOTAL.businessID',$businessId)
        ->where('USERS.email','like', $search)
        ->groupBy('USERS.email')
        ->select('USERS.email','USERS.firstName','USERS.lastName')->get();
      foreach ($patrons as $patron)
      {
        $patron->total = DB::table('SCAN_TOTAL')
          ->where([
                  ['patronID', $patron->email],
                  ['businessID', $businessId],
                  ])
          ->latest('dateTime')
          ->value('total');
      }

      return view('business/manage-patrons',['patrons'=>$patrons]);
    }

}
