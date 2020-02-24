<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Administration Module
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 2/23/2020
Synopsis: Passes proper data to the dao and handles all rules for administration tasks
Version#: 1
References: N/A
-->
*/
use App\Models\UserModel;
use mysqli;
use App\Services\Business\Data\AdminSecurityDAO;

//securityService class recieves the sent data from Logincontroller and calls the appropriate method in DAO to access the database
class AdminService{
    
    //The user's username and password are used to authenicate if the use is found in the database and returns true if a match was found
    public function authenticate($username, $password){
        //assume did not find
        $result = false;
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //check for user
        $security = new AdminSecurityDAO();
        $result = $security->findUser($username,$password,$conn);
        //return if found or not
        return $result;
    }
    
    public function findUserById($id){
        //assume did not find
        $result = false;
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //check for user
        $security = new AdminSecurityDAO();
        $result = $security->findUserById($id,$conn);
        //return if found or not
        return $result;
    }
    
    public function deleteUser($id){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //delete the user
        $security = new AdminSecurityDAO();
        $result = $security->deleteUser($id, $conn);
       //return if the user was deleted
        return $result;
    }
    
    public function suspendUser($id,$status){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //update the user status
        $security = new AdminSecurityDAO();
        $result = $security->updateUserStatus($id, $conn, $status);
        //return if the user was updated
        return $result;
    }
    
    public function changeRole($id,$role){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //update the user status
        $security = new AdminSecurityDAO();
        $result = $security->changeRole($id, $conn, $role);
        //return if the user was updated
        return $result;
    }
    
    public function findAllUsers($id){

        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //check for user | needs id as a parameter to keep from showing yourself
        $security = new AdminSecurityDAO();
        $result = $security->findAllUsers($id, $conn);
        
        return $result;       
    }
       
    public function updateUser(UserModel $updatedUser){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new user in database using user model
        $security = new AdminSecurityDAO();
        $result = $security->updateUser($updatedUser,$conn);
        return $result;        
    }
    
    //create method takes user data inputed in registeration page and send information over to the DAO to add the user profile into the Database
    public function create(UserModel $user){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new user in database using user model
        $security = new AdminSecurityDAO();
        $result = $security->makeUser($user,$conn);
        return $result;
    } 
    
    
}