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
    return view('auth.login');
});

Auth::routes();

Route::prefix('dashboard')->middleware('role:superadministrator|administrator|manager|employee|client|user')->group(function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard.dashboard');
    Route::resource('/users', 'UserController');
    Route::resource('/permissions', 'PermissionController', ['except' => 'destroy']);
    Route::resource('/roles', 'RoleController', ['except' => 'destroy']);
    Route::resource('/myprofile', 'MyProfileController');
    Route::resource('/calendar', 'CalendarController');
    Route::resource('/jobs', 'JobController');
    Route::resource('/tasks', 'TaskController');
    // Route::get('/tasks/{id}', 'TaskController@getJob')->name('tasks.create');
    Route::get('/deleted/accounts', 'DeletedController@getAccounts')->name('deleted.accounts');
    Route::get('/deleted/jobs', 'DeletedController@getJobs')->name('deleted.jobs');
    Route::delete('/deleted/{id}/accounts', 'DeletedController@restore');
    Route::delete('/deleted/accounts/{id}', 'DeletedController@delete');
    Route::delete('/deleted/{id}/jobs', 'DeletedController@restoreJob');
    Route::delete('/deleted/jobs/{id}', 'DeletedController@deleteJob');
  });

Route::get('/home', 'HomeController@index')->name('home');
