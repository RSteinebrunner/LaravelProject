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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Business\LoginService;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class LoginController extends Controller{
    public function authenticate(Request $request){
        $result = false;
        //get form data
        $username = $request->input('username');
        $password = $request->input('password');
       //create security service
       $isUser = new LoginService();
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
    //clears the session so the user logs out
    public function logoutUser()
    {
        Session::flush();
        return redirect()->route('login');
    }
}
