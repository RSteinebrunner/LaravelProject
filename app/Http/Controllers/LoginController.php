<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 5
 Module name: Login Module
 Authors: Roland Steinebrunner, Jack Setrak, Anthony Clayton
 Date: 03/09/2020
 Synopsis: Controlls login and logout processes
 Version#: 3
 References: N/A
  */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\Business\LoginService;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class LoginController extends Controller{
    
    
    /**
     * Function to authenicate that a user can use this account to login into the site 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function authenticate(Request $request){
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
        if ($result) {
            return view('loginSuccess');
        } else {
            //if no user is found then return the user to login failed view with result
            return view('loginFailure')->with("result", $result);
       }         
    }
    
    /**
     * Clears the session so the user logs out
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutUser()
    {
        Session::flush();
        return redirect()->route('login');
    }
    
    /**
     * Function that will vaildate form data to confirm the user inputed useable information
     * @param Request $request
     */
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = ['username' => 'Required | Between:1,24 ',
            'password' => 'Required | Between:1,24'];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
