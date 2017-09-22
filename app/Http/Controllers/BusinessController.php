<?php

namespace all4one\Http\Controllers;

use Illuminate\Http\Request;

class BusinessController extends Controller
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
    public function manageRewards(){ return view('business/manage-rewards'); }
    public function manageEmployees(){ return view('business/manage-employees'); }
}
