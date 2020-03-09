<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Admin Controller
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/24/2020
 Synopsis: Handles all features aministrators have over users
 Version#: 1
 References: N/A
  */
use App\Models\UserModel;
use App\Services\Business\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller{
    
    //gets the user id from session, requests an array from the admin service
    public function showAllUsers(Request $request){
        //if not a admin rereoute to login
        if(Session::get('Role') != "admin"){
            return redirect()->route('login');
        }
        $id = Session::get('User')->getId();
        $users = new AdminService();
        //result is data as an array of all user models
        $result = $users->findAllUsers($id);
        return view('showAdmin')->with('result',$result);
    }
    
    public function changeRole(Request $request){
        $id = $request->input('id');
        $role = $request->input('role');
        $users = new AdminService();
        $result = $users->changeRole($id,$role);
        if($result){
            $id = Session::get('User')->getId();
            $users = new AdminService();
            //result is data as an array of all user models
            $result = $users->findAllUsers($id);
            return view('showAdmin')->with('result',$result);
        }
        else{
            return view('managerError');
        }
    }
    
    public function deleteUser(Request $request){
        $id = $request->input('id');
        $users = new AdminService();
        $result = $users->deleteUser($id);
        if($result){
            $id = Session::get('User')->getId();
            $users = new AdminService();
            //result is data as an array of all user models
            $result = $users->findAllUsers($id);
            return view('showAdmin')->with('result',$result);
        }
        else{
            return view('managerError');
        }
    }
    
    public function suspendUser(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $users = new AdminService();
        $result = $users->suspendUser($id, $status);
        if($result){
            $id = Session::get('User')->getId();
            $users = new AdminService();
            //result is data as an array of all user models
            $result = $users->findAllUsers($id);
            return view('showAdmin')->with('result',$result);
        }
        else{
            return view('managerError');
        }       
    }
    
    public function userDetails(Request $request){
        $id = $request->input('id');
        $users = new AdminService();
        $result = $users->findUserById($id);
        if($result){
            return view('showUserDetails')->with("result",$result);
        }
        else{
            return view('managerError');
        }   
    }
    
    public function updateUser(Request $request){
        //Validate Form Data
        $this->validateForm($request);
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
        $role = $request->input('role');
        $image = null;
        $updatedUser = new UserModel($id,$username, $password, $firstName, $lastName, null, $age, $gender, $address, $hometown, $email, $phoneNumber, $role, "false");
        //pass the person object to the security service
        
        $users = new AdminService();
        $result = $users->updateUser($updatedUser);
        if($result == "true"){
            return view('myProfile');
        }
        else{
            return view('managerError');
        }     
    }
    
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = ['firstName' => 'Required | Between:1,24',
            'lastName' => 'Required | Between:1,24',
            'username' => 'Required | Between:1,24',
            'email' => 'Required | Between:1,24 | email',
            'age' => 'Required | Between:1,3 | numeric',
            'password' => 'Required | Between:1,24',
            'gender' => 'Required | Between:1,24',
            'address' => 'Required | Between:10,50',
            'hometown' => 'Required | Between:5,24',
            'phoneNumber' => 'Required | Between:10,10',];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
    
  
}
