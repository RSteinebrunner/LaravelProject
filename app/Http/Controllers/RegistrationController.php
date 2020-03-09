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
use App\Services\Business\RegistrationService;
use Illuminate\Http\Request;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class RegistrationController extends Controller{
    public function createUser(Request $request){
        //Validate Form Data
        $this->validateForm($request);
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
        $makeUser = new RegistrationService();
        $result = $makeUser->create($newUser);
        if($result=="true"){
            return view('registerSuccess');
        }
        elseif ($result == "duplicate")
        {
            return view('showRegister')->with("error","Error");
        }
        return view('registerFailure')->with("result",$result);       
    }
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Login Form
        $rules = ['firstName' => 'Required | Between:1,24',
            'lastName' => 'Required | Between:1,24',
            'username' => 'Required | Between:1,24',
            'email' => 'Required | Between:1,30 | email',
            'age' => 'Required | Between:1,3 | numeric',
            'password' => 'Required | Between:1,24',
            'gender' => 'Required | Between:1,24',
            'address' => 'Required | Between:10,80',
            'hometown' => 'Required | Between:5,30',
            'phoneNumber' => 'Required | Between:10,10',];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
