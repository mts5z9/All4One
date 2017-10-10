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

Route::middleware(['businessAdmin'])->group(function() {
  //manage employees
  Route::get('/manageEmployees','BusinessController@showManageEmployees');
  Route::get('/editEmployee/{id}','BusinessController@showEditEmployee');
  Route::get('/addEmployee', 'Auth\EmployeeRegisterController@show');
  Route::get('modifyRole/{id}/{userRole}', 'Auth\EmployeeRegisterController@modifyRole');
  Route::post('/employee-register', 'Auth\EmployeeRegisterController@registerEmployee');
  Route::post('/employee-edit/{id}', 'Auth\EmployeeRegisterController@editEmployee');
  Route::get('deleteEmployee/{id}', 'Auth\EmployeeRegisterController@removeEmployee');
  //manage rewards
  Route::get('/manageRewards','BusinessController@showManageRewards');
  Route::get('/createReward', 'BusinessController@showCreateReward');
  Route::post('/reward-create', 'BusinessController@createReward');
  //manage locations
  Route::get('/manageLocations', 'BusinessController@showManageLocations');
  Route::get('/createLocation', 'BusinessController@showCreateLocation');
  Route::post('/location-create', 'BusinessController@createLocation');
});

Route::get('/manageScans', 'BusinessController@showManageScans');

//Admin Portal Routes
Route::get('/scanner', function() {
  return view('admin/scanner');
})->middleware('admin');
