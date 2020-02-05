<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 1
 Module name: Controller
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 1/19/2020
 Synopsis: Module provides all methods needed to authenticate/ create users, and return views when requested
 Version#: 1
 References: N/A
  */
use App\Models\UserModel;
use App\Services\Business\SecurityService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class AdminController extends Controller{
    public function showAdmin(){
        return view('showAdmin');
    }
    public function showEditUser(){
        return view('showEditUser');
    }
    public function updateUser(){
        
    }
    public function showAllUsers(){
        
    }
    
    public function deleteUser(){
        
    }
    public function suspendUser(){
        
    }
    
    
  
}
