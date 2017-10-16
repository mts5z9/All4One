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
    public function __construct()
    {

    }
    use RedirectsUsers;
    protected $redirectTo = '/portalDirect';

    //scanner
    public function newScan()
    {
      DB::table('SCAN')
        ->insert([
                  'cardID' => 'patron4card',
                  'timeStamp' => '2017-10-19 10:23:54+02',
                  'locationID' => '6',
                  'businessID' => '12',
                ]);
      return view('admin.scanner');
    }
}
