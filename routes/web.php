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


Route::get('/login','LoginController@showLogin');
Route::get('/register','LoginController@showRegister');
Route::post('/doLogin', 'LoginController@authenticate');
Route::post('/doRegister', 'LoginController@createUser');


 
 