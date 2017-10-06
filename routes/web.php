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


Auth::routes();

Route::get('/portalDirect', function() {
  return view('home');
})->middleware('portal');
//User Routes
Route::get('/editAccount/{id}', function ($id) {
  $user = DB::table('USERS')
    ->where('id', $id)->first();
  return view('auth.edit-account', ['user' => $user]);
});
Route::post('/account-edit/{id}', 'UserController@editAccount');

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
Route::get('/businessWelcome', function () {
  return view('business/business-welcome');
});
Route::get('/businessRegister', 'Auth\BusinessRegisterController@show');
Route::post('/business-register', 'Auth\BusinessRegisterController@register');
Route::get('/addEmployee', 'Auth\EmployeeRegisterController@show');
Route::post('/employee-register', 'Auth\EmployeeRegisterController@registerEmployee');
Route::post('/employee-edit/{id}', 'Auth\EmployeeRegisterController@editEmployee');
Route::get('modifyRole/{id}/{userRole}', 'Auth\EmployeeRegisterController@modifyRole');
Route::get('deleteEmployee/{id}', 'Auth\EmployeeRegisterController@removeEmployee');
Route::get('/manageScans', function() {
  return view('business/manage-scans');
})->middleware('employee');
Route::get('/manageRewards', function() {
  return view('business/manage-rewards');
})->middleware('employee');
Route::get('/manageEmployees', function() {
  $employees = DB::table('USERS')
    ->where('role', 'employee')
    ->orWhere('role', 'bAdmin')
    ->select('firstName','lastName','email','role','id')
    ->orderby('lastName', 'asc')->get(); //Need query for business employees
  return view('business/manage-employees',['employees' => $employees]);
})->middleware('businessAdmin');
Route::get('/editEmployee/{id}', function($id) {
  $employee = DB::table('USERS')
    ->where('id', $id)->first();
  return view('business.edit-employee', ['employee' => $employee]);
});



//Admin Portal Routes
Route::get('/scanner', function() {
  return view('admin/scanner');
})->middleware('admin');
