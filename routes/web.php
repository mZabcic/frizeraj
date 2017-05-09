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

Route::get('/home', function () {
    return redirect('/');
});

Auth::routes();

Route::get('/termini', 'HomeController@termini');

Route::get('/korisnici', 'UserController@index')->middleware('role:admin');

Route::get('/termin/{frizer_id}/{from}/{to}', 'HomeController@rasponTermina');
