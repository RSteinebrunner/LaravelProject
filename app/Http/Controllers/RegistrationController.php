<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 6
 Module name: Register Module
 Authors: Roland Steinebrunner, Jack Setrak, Anthony Clayton
 Date: 03/09/2020
 Synopsis: Module provides all methods needed to authenticate/ create users, and return views when requested
 Version#: 2
 References: N/A
  */
use App\Models\UserModel;
use App\Services\Business\RegistrationService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Exception;
//controller hold basic methods to either route to other views or request securityservice for further user specific actions
class RegistrationController extends Controller{
    /**
     * Function that will create user with the form data they filled out
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function createUser(Request $request){
        try{
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
        //pass the person object to the registeration service
        $makeUser = new RegistrationService();
        //result will return the output of create method within the registeration service
        $result = $makeUser->create($newUser);
        if($result == "true"){
            //if result is true then take user to the register success view
            return view('registerSuccess');
        }
        //if duplicate user was found then return user to register page with error 
        elseif ($result == "duplicate")
        {
            return view('showRegister')->with("error","Error");
        }
        //otherwise take user to register failur incase the register process failed to proceed
        return view('registerFailure')->with("result",$result);   
        }
        catch(ValidationException $e1){
            throw $e1;
        }
        catch(Exception $e2){
            //return view("systemException");
        }
    }
    
    /**
     * Function that will vaildate form data to confirm the user inputed useable information
     * @param Request $request
     */
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Register Form
        $rules = ['firstName' => 'Required | Between:1,24',
            'lastName' => 'Required | Between:1,24',
            'username' => 'Required | Between:1,24',
            'email' => 'Required | Between:1,30 | email',
            'age' => 'Required | numeric',
            'password' => 'Required | Between:1,24',
            'gender' => 'Required | Between:1,24',
            'address' => 'Required | Between:10,80',
            'hometown' => 'Required | Between:5,30',
            'phoneNumber' => 'Required | Between:10,10',];
        
        // Run Data Validation Rules
        $this->validate($request, $rules);
    }
}
