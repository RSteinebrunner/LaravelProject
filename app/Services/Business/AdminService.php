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
    private $servername;
    private $username;
    private $password;
    private $dbname;
    
    public function __construct(){
        $this->servername = config("database.connections.mysql.host");
        $this->username = config("database.connections.mysql.username");
        $this->password = config("database.connections.mysql.password");
        $this->dbname = config("database.connections.mysql.database");
    }
    //The user's username and password are used to authenicate if the use is found in the database and returns true if a match was found
    public function authenticate($username, $password){
        //assume did not find
        $result = false;
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //check for user
        $security = new AdminSecurityDAO($conn);
        $result = $security->findUser($username,$password);
        //return if found or not
        return $result;
    }
    
    public function findUserById($id){
        //assume did not find
        $result = false;
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //check for user
        $security = new AdminSecurityDAO($conn);
        $result = $security->findUserById($id);
        //return if found or not
        return $result;
    }
    
    public function deleteUser($id){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //delete the user
        $security = new AdminSecurityDAO($conn);
        $result = $security->deleteUser($id);
       //return if the user was deleted
        return $result;
    }
    
    public function suspendUser($id,$status){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //update the user status
        $security = new AdminSecurityDAO($conn);
        $result = $security->updateUserStatus($id, $status);
        //return if the user was updated
        return $result;
    }
    
    public function changeRole($id,$role){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //update the user status
        $security = new AdminSecurityDAO($conn);
        $result = $security->changeRole($id, $role);
        //return if the user was updated
        return $result;
    }
    
    public function findAllUsers($id){

        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //check for user | needs id as a parameter to keep from showing yourself
        $security = new AdminSecurityDAO($conn);
        $result = $security->findAllUsers($id);
        
        return $result;       
    }
       
    public function updateUser(UserModel $updatedUser){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using user model
        $security = new AdminSecurityDAO($conn);
        $result = $security->updateUser($updatedUser);
        return $result;        
    }
    
    //create method takes user data inputed in registeration page and send information over to the DAO to add the user profile into the Database
    public function create(UserModel $user){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using user model
        $security = new AdminSecurityDAO($conn);
        $result = $security->makeUser($user);
        return $result;
    } 
    
    
}