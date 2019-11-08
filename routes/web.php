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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource("jobs", "JobController");
/*Gornje je identicno donjem.*/
/*
Route::get('/jobs', "JobController@index");
Route::get('/jobs/create', "JobController@create");
Route::get('/jobs/{id}', "JobController@show");
Route::post('/jobs', "JobController@store");
Route::get('/jobs/{id}/edit', "JobController@edit");
Route::put('/jobs/{id}', "JobController@update");
Route::delete('/jobs/{id}', "JobController@destroy");
*/
