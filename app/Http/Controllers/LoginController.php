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
class LoginController extends Controller{
    public function showLogin(){
        return view('showLogin');
    }
    public function showRegister(){
        return view('showRegister');
    }
    
    public function authenticate(Request $request){
        session_start();
        $result = false;
        //get form data
        $username = $request->input('username');
        $password = $request->input('password');
       //create security service
       $isUser = new SecurityService();
       //send username and password to service
       $result = $isUser->authenticate($username, $password);
        //check if user was found
   
        
       if($result=="true"){
           return view('loginSuccess');
       }
       else {
           return view('loginFailure')->with("result", $result);
       }
        
        
        //if yes return success,
        //else failure              
    }
    
    public function createUser(Request $request){
        //pull form data to make user
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
        //create new user object
        $newUser = new UserModel(null,$username, $password, $firstName, $lastName, null, $age, $gender, $address, $hometown, $email, $phoneNumber, "user", "false");        
        //pass the person object to the security service
        $makeUser = new SecurityService();
        if($makeUser->create($newUser)==true){
            return view('registerSuccess');
        }
        return view('registerFailure');       
    }
    
    public function logoutUser(Request $request)
    {
        if($request->session()->has('Role'))
            echo $request->session()->get('Role');
            else
                echo 'No data in the session';
    }
}
