<?php

namespace all4one\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){ return view('patron/redeem'); }
    public function redeem(){ return view('patron/redeem'); }
    public function scanHistory(){ return view('patron/scan-history'); }
    public function rewardHistory(){ return view('patron/reward-history'); }
}
