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

Route::get('/home', function () {
    return redirect()->to('/login');
});

Route::get('/', function () {
    return redirect()->to('/login');
});

Route::get('/programmers/new', function () {
    return view('/register-dev');
});

Route::post('/programmers/new', 'PublicController@registerDev')->name('dev.store');

#Route::get('/users/public_users', function (){
/*Route::get('public_users', function () {
    return view('/public-users/form');
})->name('public_users');*/

Route::get('/users/public_users/{client_id}', 'PublicController@registerPublic')->name('public_users.new');

Route::post('/public_users', 'PublicController@registerPublicUserStore')->name('public_users.store');

Route::post('/programmers/new', 'PublicController@registerDev')->name('dev.store');

include("rlustosa.php");
Auth::routes();

