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
Route::get('logout', function(){
    Auth::logout();
    return redirect('login');
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['Kepala SPKP']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    });

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index');
    Route::post('input', 'UserController@input');
    Route::post('edit/{id}', 'UserController@edit');
    Route::post('delete/{id}', 'UserController@delete');
    Route::get('listjabatan', 'UserController@listjabatan');
    Route::get('listpangkat', 'UserController@listpangkat');
});

