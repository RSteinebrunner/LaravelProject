<?php 
namespace App\Models;
/*
 * <!--  
Project name/Version: LaravelCLC Version: 1
Module name: UserModel
Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
Date: 1/19/2020
Synopsis: Module provides the base model of the user instance 
Version#: 1
References: N/A
-->
 */
//user model class outlines all user data
class UserModel{    
    public $firstName;
    public $lastName;
    public $username;
    public $password;
    public $age;
    public $email;
    public $role = null;
    
    //constructor method 
    public function __construct($fname,$lname,$uname,$pswd,$age,$email){
        $this->firstName = $fname;
        $this->lastName = $lname;
        $this->username = $uname;
        $this->password= $pswd;
        $this->age = $age;
        $this->email = $email;
    }
}
?>