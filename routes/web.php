<!--  
Project name/Version: LaravelCLC Version: 1
Module name: Routes
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: Module provides all routing details for controllers and views
Version#: 1
References: N/A
-->

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
Route::get('/loginSuccess',function () {
    return view('loginSuccess');
});
Route::get('/admin',function () {
    return view('showAdmin');
});
Route::get('/profile',function () {
    return view('myProfile');
})->name('profile');
        
Route::get('/logout','LoginController@logoutUser');
Route::get('/login','LoginController@showLogin')->name('login');
Route::get('/register','LoginController@showRegister');
Route::post('/doLogin', 'LoginController@authenticate');
Route::post('/doRegister', 'LoginController@createUser');

Route::get('/manageUsers', 'AdminController@showAllUsers')->name('manageUsers');
Route::post('/suspendUser', 'AdminController@suspendUser');
Route::post('/deleteUser', 'AdminController@deleteUser');
Route::post('/userDetails', 'AdminController@userDetails');
Route::post('/updateDetails', 'AdminController@updateUser');
Route::post('/changeRole', 'AdminController@changeRole');





 
 