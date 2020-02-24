<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Routes
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 2/23/2020
Synopsis: Module provides all routing details for controllers and views
Version#: 5
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

Route::get('/admin',function () {
    return view('showAdmin');
});

Route::get('/profile',function () {
    return view('myProfile');
})->name('profile');

Route::get('/login',function () {
    return view('showLogin');
})->name('login');

Route::get('/register',function () {
    return view('showRegister');
});

Route::get('/portfolio', 'PortfolioController@showPortfolio')->name('portfolio');
Route::post('/deleteEducation', 'EducationController@deleteEducation');
Route::post('/addEducation', 'EducationController@addEducation');
        
Route::get('/logout','LoginController@logoutUser');
Route::post('/doLogin', 'LoginController@authenticate');

Route::post('/doRegister', 'RegistrationController@createUser');

Route::get('/manageUsers', 'AdminController@showAllUsers')->name('manageUsers');
Route::post('/suspendUser', 'AdminController@suspendUser');
Route::post('/deleteUser', 'AdminController@deleteUser');
Route::post('/userDetails', 'AdminController@userDetails');
Route::post('/updateDetails', 'AdminController@updateUser');
Route::post('/changeRole', 'AdminController@changeRole');





 
 