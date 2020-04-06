<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Routes
Authors: Roland Steinebrunner, Jack Setrak, Anthony Clayton
Date: 3/12/2020
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
    return view('showLogin');
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
Route::get('/newEducation',function () {
   return view('addEducation');
});
Route::get('/newSkills', function () {
    return view('addSkills');
});
Route::get('/newJobHistory', function () {
    return view('addJobHistory');
});
Route::get('/editPortfolio',function () {
    return view('editPortfolio');
});
Route::get('/showHome',function () {
    return view('showHomePage');
});
Route::get('/addGroups',function () {
    return view('addGroups');
});

Route::get('/createJob',function () {
    return view('addJobPosting');
});

Route::get('/groups', 'GroupController@showAllGroups');
Route::get('/myGroups', 'GroupController@showMyGroups');

Route::post('/showMembers','GroupController@showAllMembers');
Route::post('/editGroup', 'GroupController@editGroup');
Route::post('/editGroupPosting', 'GroupController@editGroupPosting');
Route::post('/deleteGroupPosting', 'GroupController@deleteGroup');

Route::post('/joinGroup', 'GroupController@joinGroup');
Route::post('/leaveGroup', 'GroupController@leaveGroup');
Route::post('/addGroupPosting', 'GroupController@addGroup');

Route::get('/jobPosting', 'JobPostingController@showAllJobs');
Route::get('/showDetailPage', 'JobPostingController@showJobDetails');
Route::get('/adminJobPosting', 'JobPostingController@findJob');
Route::post('/editJobPosting', 'JobPostingController@editPost');
Route::post('/deleteJobPosting', 'JobPostingController@deletePost');
Route::post('/addJobPosting', 'JobPostingController@addPost');
Route::post('/searchJobs', 'JobPostingController@searchJobs');
Route::post('/applyJob', 'JobPostingController@applyJob');

Route::get('/portfolio', 'PortfolioController@showPortfolio');

Route::post('/deleteEducation', 'EducationController@deleteEducation');
Route::post('/addEducation', 'EducationController@addEducation');

Route::post('/deleteSkill', 'SkillsController@deleteSkills');
Route::post('/addSkill', 'SkillsController@addSkill');

Route::post('/addJobHistory', 'JobHistoryController@addJobHistory');
Route::post('/deleteHistory', 'JobHistoryController@deleteJobHistory');

Route::get('/logout','LoginController@logoutUser');
Route::post('/doLogin', 'LoginController@authenticate');

Route::post('/doRegister', 'RegistrationController@createUser');

Route::get('/manageUsers', 'AdminController@showAllUsers');
Route::post('/suspendUser', 'AdminController@suspendUser');
Route::post('/deleteUser', 'AdminController@deleteUser');
Route::post('/userDetails', 'AdminController@userDetails');
Route::post('/updateDetails', 'AdminController@updateUser');
Route::post('/changeRole', 'AdminController@changeRole');

//Rest services
Route::resource('/userProfile', 'usersRestController');
Route::resource('/allJobs', 'jobsRestController');
Route::resource('/getJob', 'jobsRestController');



 
 