<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/redeem', 'HomeController@redeem');
Route::get('/scanHistory', 'HomeController@scanHistory');
Route::get('/rewardHistory', 'HomeController@rewardHistory');

//Route::get('/manageRewards', function() {
//  return view('business/manage-rewards');
//})->middleware('business');
Route::get('/manageRewards', 'BusinessController@manageRewards');
Route::get('/manageEmployees', 'BusinessController@manageEmployees');

Route::get('/scanner', 'AdminController@scanner');

//Route::prefix('admin')->group(function() {
//  Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
//  Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
//  Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
//});

Route::get('/employee', 'EmployeeController@index');
