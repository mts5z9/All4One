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

class PatronController extends Controller
{

    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';

    //Register Card
    public function showRegister()
    {
      return view('patron.register-card');
    }
    public function registerCard(Request $request)
    {
      $userEmail = Auth::user()->email;
      $this->validateCard($request->all())->validate();
      if($userAccount = DB::table('ACCOUNT')->where('patronEmail', $userEmail)->first())
      {
        DB::table('NFC_CARD')
          ->insert(['cardID' => $request['cardID']]);
        DB::table('ACCOUNT')
          ->where('cardID', $userAccount->cardID)
          ->update(['cardID' => $request['cardID']]);
        DB::table('NFC_CARD')
          ->where('cardID', $userAccount->cardID)
          ->delete();
      }
      else
      {
        DB::table('NFC_CARD')
          ->insert(['cardID' => $request['cardID']]);
        DB::table('ACCOUNT')
          ->insert([
                    'patronEmail' => $userEmail,
                    'accountStatus' => 'actv',
                    'cardID' => $request['cardID'],
                  ]);
      }
      return redirect('/portalDirect');
    }
    public function showRewards()
    {
      $cardID = DB::table('ACCOUNT')->where('patronEmail','=',Auth::user()->email)->value('cardID');
      $rewards = DB::table('REWARD')
        ->join('BUSINESS','BUSINESS.businessID','=','REWARD.businessID')
        ->leftJoin('SCAN','REWARD.businessID','=', 'SCAN.businessID')
        ->where([
                ['REWARD.rewardStatus','=','actv'],
                ['SCAN.cardID', '=', $cardID],
                ])
        ->groupBy('REWARD.rewardID','BUSINESS.businessName')
        ->select('REWARD.*','BUSINESS.businessName')
        ->orderby('BUSINESS.businessName','asc')->get();
      foreach ($rewards as $reward)
      {
        $reward->points = DB::table('SCAN_TOTAL')
                    ->where([
                            ['patronID', Auth::user()->email],
                            ['businessID', $reward->businessID],
                            ])
                    ->latest('dateTime')
                    ->value('total');
      }
      return view('patron.rewards',['rewards'=>$rewards]);
    }
    public function claim($rewardID)
    {
      $pointsTotal = DB::table('SCAN_TOTAL')
                        ->join('REWARD', 'REWARD.businessID','=','SCAN_TOTAL.businessID')
                        ->where([
                                ['SCAN_TOTAL.patronID', Auth::user()->email],
                                ['REWARD.rewardID', $rewardID],
                                ])
                        ->latest('SCAN_TOTAL.dateTime')
                        ->value('SCAN_TOTAL.total');
      $pointsSpent = DB::table('REWARD')->where('rewardID',$rewardID)->value('pointsNeeded');
      if($pointsTotal > $pointsSpent)
      {
        DB::table('CLAIMED_REWARD')
        ->insert([
                  'patronID' => Auth::user()->email,
                  'rewardID' => $rewardID,
                  'claimTimeStamp' => date('Y-m-d H:i:sO'),
                  'pointsSpent' => $pointsSpent,
                ]);
      }
      return redirect('/rewards');
    }
    public function validateCard(array $data)
    {
      return Validator::make($data, [
        'cardID' => 'required|string|max:255|unique:ACCOUNT',
      ]);
    }
    public function showParticipatingBusinesses()
    {
      $businesses = DB::table('BUSINESS')
        ->orderby('businessName','asc')->get();
      return view('patron.participating-businesses',['businesses'=> $businesses]);
    }
    public function showRewardHistory()
    {
      $rewards = DB::table('CLAIMED_REWARD')
                  ->join('REWARD','REWARD.rewardID','=','CLAIMED_REWARD.rewardID')
                  ->join('BUSINESS','BUSINESS.businessID','=','REWARD.businessID')
                  ->where('CLAIMED_REWARD.patronID',Auth::user()->email)
                  ->select('BUSINESS.businessName','REWARD.title','REWARD.descr','CLAIMED_REWARD.pointsSpent','CLAIMED_REWARD.claimTimeStamp')
                  ->orderBy('CLAIMED_REWARD.claimTimeStamp','dec')->get();
      return view('patron.reward-history',['rewards'=> $rewards]);
    }
    public function showScanHistory()
    {
      $cardID = DB::table('ACCOUNT')->where('patronEmail',Auth::user()->email)->value('cardID');
      $scans = DB::table('SCAN')
                ->join('BUSINESS','BUSINESS.businessID','=','SCAN.businessID')
                ->join('LOCATION','LOCATION.locationID','=','SCAN.locationID')
                ->where('SCAN.cardID',$cardID)
                ->select('BUSINESS.businessName','LOCATION.city','LOCATION.state','SCAN.timeStamp')
                ->orderBy('SCAN.timeStamp','dec')->get();
      return view('patron.scan-history',['scans'=>$scans]);
    }


}
