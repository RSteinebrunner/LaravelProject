<?php
namespace App\Http\Controllers;

/*
 Project name/Version: LaravelCLC Version: 5
 Module name: Admin Controller
 Authors: Roland Steinebrunner, Jack Setrak, Anthony Clayton
 Date: 03/09/2020
 Synopsis: Handles all features aministrators have over users
 Version#: 2
 References: N/A
  */
use App\Models\UserModel;
use App\Services\Business\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller{
    
    /**
     * gets the user id from session, requests an array from the admin service
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function showAllUsers(Request $request){
        //if not a admin rereoute to login
        if(Session::get('Role') != "admin"){
            return redirect()->route('login');
        }
        $id = Session::get('User')->getId();
        $users = new AdminService();
        $result = $users->findAllUsers($id);
        return view('showAdmin')->with('result',$result);
    }
    
    /**
     * Function that will allow an admin to change role of a user
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function changeRole(Request $request){
        //recieve form information of the user the admin is trying to edit
        $id = $request->input('id');
        $role = $request->input('role');
        //create new instanse of admin service
        $users = new AdminService();
        //call change role method passing user id and his current role
        $result = $users->changeRole($id,$role);
        if($result){
            //if result is true then take admin back to show all user view to see the new changes 
            $id = Session::get('User')->getId();
            $users = new AdminService();
            $result = $users->findAllUsers($id);
            return view('showAdmin')->with('result',$result);
        }
        else{
            return view('managerError');
        }
    }
    
    /**
     * Function used to delete a user 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function deleteUser(Request $request){
        //recieve the id of the user an admin is trying to delete
        $id = $request->input('id');
        $users = new AdminService();
        $result = $users->deleteUser($id);
        if($result){
            //if true then take admin back to show all uses view that will show all other users besides the deleted one
            $id = Session::get('User')->getId();
            $users = new AdminService();
            $result = $users->findAllUsers($id);
            return view('showAdmin')->with('result',$result);
        }
        else{
            return view('managerError');
        }
    }
    
    /**
     * Function that will suspend a user which will not allow them to login
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function suspendUser(Request $request){
        $id = $request->input('id');
        $status = $request->input('status');
        $users = new AdminService();
        //call method suspend useer from admin service passing the id and current status of the user that the admin is trying to edit
        $result = $users->suspendUser($id, $status);
        if($result){
            $id = Session::get('User')->getId();
            $users = new AdminService();
            $result = $users->findAllUsers($id);
            return view('showAdmin')->with('result',$result);
        }
        else{
            return view('managerError');
        }       
    }
    
    /**
     * Function that will allow an admin to view all of the selected users information 
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function userDetails(Request $request){
        $id = $request->input('id');
        $users = new AdminService();
        //call method in admin service to return the user that matches the passed Id parameter 
        $result = $users->findUserById($id);
        if($result){
            return view('showUserDetails')->with("result",$result);
        }
        else{
            return view('managerError');
        }   
    }
    
    /**
     * Function that allows an admin to update a users information
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
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
    
    /**
     * Function that will validate information recieved from form
     * @param Request $request
     */
    private function validateForm(Request $request)
    {
        // Setup Data Validation Rules for Admin Form
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
