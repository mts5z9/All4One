<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Auth::routes();

Route::get('/', function () {
    return view('home');
});
Route::get('/portalDirect', function() {
  return view('home');
})->middleware('portal');

//User Routes
Route::get('/editAccount/{id}','UserController@showEdit');
Route::post('/account-edit/{id}', 'UserController@editAccount');
Route::get('/changePassword','UserController@showChangePassword');
Route::post('/change-password','UserController@changePassword');

//Patron Portal Routes
Route::middleware(['patron'])->group(function () {
  Route::get('/rewards','PatronController@showRewards');
  Route::get('/claim/{id}','PatronController@claim');
  Route::get('/registerCard','PatronController@showRegister');
  Route::post('/register-card','PatronController@registerCard');
  Route::get('/participatingBusinesses','PatronController@showParticipatingBusinesses');
  Route::get('/rewardHistory','PatronController@showRewardHistory');
  Route::get('/scanHistory','PatronController@showScanHistory');
  Route::get('/redeem', function() { return view('patron/redeem'); });
  Route::get('/availableRewards','PatronController@showClaimedRewards');
});

//Business Portal Routes
Route::get('/businessWelcome', function () {return view('business/business-welcome');});
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
  Route::get('/editScanner/{id}','BusinessScannerController@showEdit');
  Route::post('/edit-scanner/{id}','BusinessScannerController@edit');
  Route::get('/scannerStatus/{id}','BusinessScannerController@changeStatus');
  //Statistics
  Route::get('/scanStats/{time}','BusinessStatsController@showScanStats');
  Route::get('/rewardStats/{time}','BusinessStatsController@showRewardStats');
});
Route::middleware(['businessOwner'])->group(function() {
  Route::get('/editBusinessAccount','BusinessController@showEditAccount');
  Route::post('/edit-businessAccount','BusinessController@editAccount');
});
Route::middleware(['employee'])->group(function() {
  Route::get('/manageScans', 'BusinessScanController@showManageScans');
  Route::get('/managePatrons', 'BusinessScanController@showManagePatrons');
  Route::get('/customerRewards/{id}','BusinessScanController@showpatronRewards');
  Route::get('/useReward/{id}/{email}/{timeStamp}','BusinessScanController@useReward');
  Route::post('/searchManagePatrons','BusinessScanController@searchManagePatrons');
  Route::get('/addScan/{id}', 'BusinessScanController@addScan');
  Route::get('/removeScan/{id}/{timeStamp}','BusinessScanController@removeScan');
});

//Admin Portal Routes
Route::middleware(['admin'])->group(function() {
  Route::get('/scanner','ScannerController@showScanner');
  Route::post('/scan','ScannerController@scanProgress');
  Route::post('/newScan','ScannerController@newScan');
});
