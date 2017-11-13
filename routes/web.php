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
Route::get('/changePassword','UserController@showChangePassword');
Route::post('/change-password','UserController@changePassword');
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
Route::middleware(['patron'])->group(function () {
  Route::get('/rewards','PatronController@showRewards');
  Route::get('/claim/{id}','PatronController@claim');
  Route::get('/registerCard','PatronController@showRegister');
  Route::post('/register-card','PatronController@registerCard');
  Route::get('/participatingBusinesses','PatronController@showParticipatingBusinesses');
  Route::get('/rewardHistory','PatronController@showRewardHistory');
  Route::get('/scanHistory','PatronController@showScanHistory');
});

//Business Portal Routes
Route::get('/businessWelcome', function () {
  return view('business/business-welcome');
});
Route::get('/businessRegister', 'Auth\BusinessRegisterController@show');
Route::post('/business-register', 'Auth\BusinessRegisterController@register');

Route::middleware(['businessAdmin'])->group(function() {
  //manage employees
  Route::get('/manageEmployees/{status}','BusinessEmployeeController@show');
  Route::get('/editEmployee/{id}','BusinessEmployeeController@showEdit');
  Route::get('/addEmployee', 'Auth\EmployeeRegisterController@show');
  Route::get('/modifyRole/{id}/{userRole}', 'Auth\EmployeeRegisterController@modifyRole');
  Route::post('/employee-register', 'Auth\EmployeeRegisterController@registerEmployee');
  Route::post('/employee-edit/{id}', 'BusinessEmployeeController@edit');
  Route::get('/employeeStatus/{id}', 'BusinessEmployeeController@changeStatus');
  //manage rewards
  Route::get('/manageRewards/{status}','BusinessRewardController@show');
  Route::get('/createReward', 'BusinessRewardController@showCreate');
  Route::post('/reward-create', 'BusinessRewardController@create');
  Route::get('/rewardStatus/{id}','BusinessRewardController@changeStatus');
  Route::get('/editReward/{id}','BusinessRewardController@showEdit');
  Route::post('/edit-reward/{id}','BusinessRewardController@edit');
  //manage locations
  Route::get('/manageLocations/{status}', 'BusinessLocationController@show');
  Route::get('/createLocation', 'BusinessLocationController@showCreate');
  Route::post('/location-create', 'BusinessLocationController@create');
  Route::get('/editLocation/{id}', 'BusinessLocationController@showEdit');
  Route::post('/edit-location/{id}', 'BusinessLocationController@edit');
  Route::get('/locationStatus/{id}','BusinessLocationController@changeStatus');
  //manage Scanners
  Route::get('/manageScanners/{status}','BusinessScannerController@show');
  Route::get('/addScanner','BusinessScannerController@showCreate');
  Route::post('/add-scanner','BusinessScannerController@create');
  Route::get('/scannerStatus/{id}','BusinessScannerController@changeStatus');
  //Statistics
  Route::get('/scanStats/{time}','BusinessStatsController@showScanStats');
  Route::get('/rewardStats/{time}','BusinessStatsController@showRewardStats');
});

Route::get('/manageScans', 'BusinessController@showManageScans');

//Admin Portal Routes
Route::middleware(['admin'])->group(function() {
  Route::get('/scanner','ScannerController@showScanner');
  Route::post('/scan','ScannerController@newScan');
});
