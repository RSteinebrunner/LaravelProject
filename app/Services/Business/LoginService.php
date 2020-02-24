<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Login Module
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 2/23/2020
Synopsis: passes data to the login dao and makes sure that the proper user is found
Version#: 1
References: N/A
-->
*/
use App\Models\UserModel;
use mysqli;
use App\Services\Business\Data\LoginDAO;

//securityService class recieves the sent data from Logincontroller and calls the appropriate method in DAO to access the database
class LoginService{
    //The user's username and password are used to authenicate if the use is found in the database and returns true if a match was found
    public function authenticate($username, $password){
        //assume did not find
        $result = false;
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //check for user
        $security = new LoginDAO();
        $result = $security->findUser($username,$password,$conn);
        //return if found or not
        return $result;
    }
  
}