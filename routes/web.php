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
    return redirect()->to('/login');
});

Route::get('/programmers/new', function () {
    return view('/register-dev');
});

Route::post('/programmers/new', 'PublicController@registerDev')->name('dev.store');

include("rlustosa.php");
Auth::routes();

