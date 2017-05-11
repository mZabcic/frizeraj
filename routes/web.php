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
//termini
Route::get('/termini', 'HomeController@termini')->name('termini');
Route::get('/korisnici', 'UserController@index')->middleware('role:admin');
Route::get('/termin/{frizer_id}/{from}/{to}', 'HomeController@rasponTermina');
Route::post('/termin', 'HomeController@rezervacijaTermina')->name('rezervacijaTermina');
Route::get('/admin', function () {
    return view('admin.admin');
})->middleware('role:admin');

//admin stuff
Route::get('/admin/korisnici', 'UserController@customers')->middleware('role:admin');
Route::get('/admin/frizeri', 'UserController@hairdressers')->middleware('role:admin');
Route::get('/admin/administratori', 'UserController@admins')->middleware('role:admin');
Route::post('/admin/korisnici/create', 'UserController@create')->middleware('role:admin');
//misc stvari za admina
Route::get('/admin/poslovi', 'AdminJobsController@poslovi')->middleware('role:admin');
Route::get('/admin/posao/dodaj', 'AdminJobsController@dodajPosao')->middleware('role:admin');
Route::post('/admin/posao/dodaj', 'AdminJobsController@upisiPosao')->middleware('role:admin');
Route::get('/admin/posao/{id}', 'AdminJobsController@posao')->middleware('role:admin');
Route::post('/admin/posao/{id}', 'AdminJobsController@upisiPosao')->middleware('role:admin');



Route::get('/admin/korisnici/novi', function () {
    return view('admin.createUser');
})->middleware('role:admin');

Route::delete('/admin/korisnici/{id}/delete', 'UserController@delete')->middleware('role:admin');
