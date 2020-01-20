<?php

//always make sure this matches
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Business\SecurityService;
use App\Http\Models\UserModel;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('showLogin');
    }
    public function showRegister(){
        return view('showRegister');
    }
    public function authenticate(Request $request)
    {
        $result = false;
        //get form data
        $username = $request->input('username');
        $password = $request->input('password');
       //create security service
       $isUser = new SecurityService();
       //send username and password to service
       $result = $isUser->authenticate($username, $password);
        //check if user was found
        if($result == true)
        {
            return view('loginSuccess');
        }
        else {
            return view('loginFailure');
        }
        //if yes return success,
        //else failure
        
       
    }
    public function createUser(Request $request)
    {
        //pull form data to make user
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $username = $request->input('username');
        $password = $request->input('password');
        $age = $request->input('age');
        $email = $request->input('email');
        
        //create new user object
        $newUser = new UserModel($firstName, $lastName, $username, $password, $age, $email);        
        //pass the person object to the security service
        $makeUser = new SecurityService();
        if($makeUser->create($newUser)==true)
        {
            return view('registerSuccess');
        }
        return view('registerFailure');
        
    }
}
