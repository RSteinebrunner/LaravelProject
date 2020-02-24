<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Business\Data\RegistrationDAO;
use mysqli;
/*
 <!--
 Project name/Version: LaravelCLC Version: 3
 Module name: Registration Module
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/23/2020
 Synopsis: Business Service rules for registrations, connects to Registration DAO
 Version#: 1
 References: N/A
 -->
 */
class RegistrationService{
    //Method to add a new user
    //create method takes user data inputed in registeration page and send information over to the DAO to add the user profile into the Database
    public function create(UserModel $user){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new user in database using user model
        $security = new RegistrationDAO();
        $result = $security->findByUsername($user->getUsername(), $conn);
        //check if it is duplicate
        if($result == "true"){
            //return duplicate to controller if true
            return "duplicate";
        }
        else{
            //if no duplicate found make the user
            $result = $security->makeUser($user, $conn);
            //relay if successfull to the controller
            if($result=="true")
                return "true";
            return "false";
        }
    }    
    
}