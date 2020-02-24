<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Login Module
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/24/2020
 Synopsis: Controlls login and logout processes
 Version#: 2
 References: N/A
  */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Business\LoginService;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class LoginController extends Controller
{

    public function authenticate(Request $request)
    {
        //Validate Form Data
        $this->validateForm($request);
        // get form data
        $username = $request->input('username');
        $password = $request->input('password');
        // create security service
        $isUser = new LoginService();
        // send username and password to service
        $result = $isUser->authenticate($username, $password);
        // check if user was found

        if ($result == "true") {
            return view('loginSuccess');
        } else {
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
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between:1,24 ',
            'password' => 'Required | Between:1,24'];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
