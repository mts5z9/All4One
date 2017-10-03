<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Route::get('/', function () {
    return view('home');
});
Route::get('/editAccount', function() {
  return view('edit-account');
});

Auth::routes();
Route::resource('/user', 'UserController');

Route::get('/portalDirect', function() {
  return view('home');
})->middleware('portal');


//Patron Portal Routes
Route::get('/redeem', function() {
  return view('patron/redeem');
})->middleware('patron');
Route::get('/scanHistory', function() {
  return view('patron/scan-history');
})->middleware('patron');
Route::get('/rewardHistory', function() {
  return view('patron/reward-history');
})->middleware('patron');

//Business Portal Routes
Route::get('/manageScans', function() {
  return view('business/manage-scans');
})->middleware('employee');
Route::get('/manageRewards', function() {
  return view('business/manage-rewards');
})->middleware('employee');
Route::get('/manageEmployees', function() {
  $employees = DB::table('USERS')->select('firstName','lastName','email','role','id')->get(); //Need query for business employees
  return view('business/manage-employees',['employees' => $employees]);
})->middleware('businessAdmin');



//Admin Portal Routes
Route::get('/scanner', function() {
  return view('admin/scanner');
})->middleware('admin');
