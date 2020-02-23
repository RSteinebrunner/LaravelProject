<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 1
 Module name: Controller
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 1/19/2020
 Synopsis: Module provides all methods needed to update/delete users, and return views when requested
 Version#: 1
 References: N/A
  */
use App\Models\UserModel;
use App\Services\Business\AdminSecurityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class AdminController extends Controller{
    
    public function showAllUsers(Request $request){
        $id = Session::get('User')->getId();
        $users = new AdminSecurityService();
        $result = $users->findAllUsers($id);
        return view('showAdmin')->with('result',$result);
    }
    
    public function changeRole(Request $request){
        $id = $request->input('id');
        $role = $request->input('role');
        $users = new AdminSecurityService();
        $result = $users->changeRole($id,$role);
        if($result){
            return redirect()->route('manageUsers');
        }
        else{
            return view('managerError');
        }
    }
    
    public function deleteUser(Request $request){
        $id = $request->input('id');
        $users = new AdminSecurityService();
        $result = $users->deleteUser($id);
        if($result){
            return redirect()->route('manageUsers');
        }
        else{
            return view('managerError');
        }
    }
    
    public function suspendUser(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $users = new AdminSecurityService();
        $result = $users->suspendUser($id, $status);
        if($result){
            return redirect()->route('manageUsers');
        }
        else{
            return view('managerError');
        }       
    }
    
    public function userDetails(Request $request){
        $id = $request->input('id');
        $users = new AdminSecurityService();
        $result = $users->findUserById($id);
        if($result){
            return view('showUserDetails')->with("result",$result);
        }
        else{
            return view('managerError');
        }   
    }
    
    public function updateUser(Request $request){
        //pull form data to make user
        $id = $request->input('id');
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $username = $request->input('username');
        $password = $request->input('password');
        $age = $request->input('age');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $address = $request->input('address');
        $hometown = $request->input('hometown');
        $phoneNumber = $request->input('phoneNumber');
        $image = null;
        $updatedUser = new UserModel($id,$username, $password, $firstName, $lastName, null, $age, $gender, $address, $hometown, $email, $phoneNumber, "user", "false");
        //pass the person object to the security service
        
        $users = new AdminSecurityService();
        $result = $users->updateUser($updatedUser);
        if($result == "true"){
            return redirect()->route('profile');
        }
        else{
            return view('managerError');
        }     
    }
    
    
    
  
}
