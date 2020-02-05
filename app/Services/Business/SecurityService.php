<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 1
Module name: SecurityService
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: Module provides methods passes data to the securityDAO so it can recieve database information
Version#: 1
References: N/A
-->
*/
use App\Models\UserModel;
use mysqli;
use App\Services\Business\Data\SecurityDAO;

//securityService class recieves the sent data from Logincontroller and calls the appropriate method in DAO to access the database
class SecurityService{
    //The user's username and password are used to authenicate if the use is found in the database and returns true if a match was found
    public function authenticate($username, $password){
        //assume did not find
        $result = false;
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //check for user
        $security = new SecurityDAO();
        $result = $security->findUser($username,$password,$conn);
        //return if found or not
        return $result;
    }
    
    //create method takes user data inputed in registeration page and send information over to the DAO to add the user profile into the Database
    public function create(UserModel $user){
        //assume creation of user failse
        $result = false;
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new user in database using user model
        $security = new SecurityDAO();
        $result = $security->makeUser($user,$conn);
        return $result;
    }     
}