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

Route::post('/korisnik/postCredentials', 'UserController@postCredentials')->name('postLozinka');

ROUTE::get('/promijeniLozinku','UserController@changePassword')->name('lozinka');
//basic tabovi
ROUTE::get('/cjenik', 'HomeController@cjenik')->name('cjenik');

//frizeri
ROUTE::get('/frizeri', 'HomeController@frizeri')->name('frizeri');
ROUTE::get('/frizer/{id}', 'HomeController@frizer')->name('frizer');
ROUTE::post('/frizer/{id}/omiljeni', 'HomeController@omiljeniFrizer')->name('omiljeniFrizer');


//termini
Route::get('/termini', 'AssignmentController@termini')->name('termini');
Route::get('/korisnici', 'UserController@index')->middleware('role:admin');
Route::get('/termin/{frizer_id}/{from}/{to}', 'AssignmentController@rasponTermina');
Route::post('/termin', 'AssignmentController@rezervacijaTermina')->name('rezervacijaTermina');
Route::get('/admin', function () {
    return view('admin.admin');
})->middleware('role:admin');

//admin stuff
Route::get('/admin/korisnici', 'UserController@customers')->middleware('role:admin');
Route::get('/admin/frizeri', 'UserController@hairdressers')->middleware('role:admin');
Route::get('/admin/administratori', 'UserController@admins')->middleware('role:admin');
Route::post('/admin/korisnici/create', 'UserController@create')->middleware('role:admin');
Route::get('/admin/korisnici/novi', function () {
    return view('admin.createUser');
})->middleware('role:admin');

Route::delete('/admin/korisnici/{id}/delete', 'UserController@delete')->middleware('role:admin');
Route::post('/admin/korisnici/update', 'UserController@update')->middleware('role:admin');


//misc stvari za admina
Route::get('/admin/poslovi', 'AdminJobsController@poslovi')->middleware('role:admin');
Route::get('/admin/korisnici/{id}/uredi', 'UserController@edit')->middleware('role:admin');
Route::get('/admin/posao/dodaj', 'AdminJobsController@dodajPosao')->middleware('role:admin');
Route::post('/admin/posao/dodaj', 'AdminJobsController@upisiPosao')->middleware('role:admin');
Route::delete('/admin/posao/{id}/obrisi', 'AdminJobsController@obrisiPosao')->middleware('role:admin');

Route::get('/admin/frizer/{id}/vrijeme', 'UserController@radnoVrijeme')->middleware('role:admin');
Route::post('/admin/frizer/{id}/vrijeme', 'UserController@promijeniRadnoVrijeme')->middleware('role:admin')->name('promijeniRadnoVrijeme');
