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
use mysqli;
use App\Services\Business\Data\LoginDAO;
use Illuminate\Support\Facades\Session;


//securityService class recieves the sent data from Logincontroller and calls the appropriate method in DAO to access the database
class LoginService{
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
        $security = new LoginDAO($conn);
        $user= $security->findUser($username,$password);
        if($user != null && $user->getUsername() == $username && $user->getPassword() == $password){
            Session::put('User',$user);
            Session::put('Role', $user->getRole());
            return "true";
        }
        else{
            return "false";
        }
    }
  
}