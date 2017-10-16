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
    public function __construct()
    {

    }
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

}
