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


class BusinessRewardController extends BusinessController
{
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';
    public function show($status)
    {
      $businessId = $this->getBusinessID();
      $rewards = DB::table('REWARD')
        ->where([
                  ['businessID','=',$businessId],
                  ['rewardStatus','=',$status],
                ])
        ->orderby('title', 'asc')->get();
      return view('business/manage-rewards',['rewards' => $rewards, 'status'=> $status]);
    }
    public function showCreate()
    {
      return view('business.add-reward');
    }
    public function create(Request $request)
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
      return redirect('/manageRewards/actv');

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
    public function changeStatus($id) {
      $reward = DB::table('REWARD')->where('rewardID',$id)->first();

      if($reward->rewardStatus == 'actv')
      {
        DB::table('REWARD')
        ->where('rewardID', $id)
        ->update(['rewardStatus'=>'inactv']);
          return redirect('/manageRewards/actv');
      } else if ($reward->rewardStatus == 'inactv')
      {
        DB::table('REWARD')
          ->where('rewardID', $id)
          ->update(['rewardStatus'=>'actv']);
          return redirect('/manageRewards/inactv');
      }
    }
    public function showEdit($id)
    {
      $reward = DB::table('REWARD')
        ->where('rewardID',$id)->first();
      return view('business.edit-reward', ['reward' => $reward]);
    }
    public function edit(Request $request, $id)
    {
      $businessID = $this->getBusinessID();
      $this->validateReward($request->all())->validate();
      DB::table('REWARD')
       ->where('rewardID', $id)
       ->update([
                 'title' => $request['title'],
                 'descr' => $request['descr'],
                 'pointsNeeded' => $request['pointsNeeded'],
                 'beginDate' => $request['beginDate'],
                 'endDate' => $request['endDate'],
               ]);
      $status = DB::table('REWARD')->where('rewardID',$id)->value('rewardStatus');
      $redirect = '/manageRewards/'.$status;
      return redirect($redirect);
    }
}
