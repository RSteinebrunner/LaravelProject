<?php
namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Business\Data\RegistrationDAO;
use mysqli;
/*
 <!--
 Project name/Version: LaravelCLC Version: 6
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
    //create method takes user data inputed in registeration page and send information over to the DAO to add the user profile into the Database
    public function create(UserModel $user){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using user model
        $security = new RegistrationDAO($conn);
        $result = $security->findByUsername($user->getUsername());
        //check if it is duplicate
        if($result == true){
            //return duplicate to controller if true
            return "duplicate";
        }
        else{
            //if no duplicate found make the user
            $result = $security->makeUser($user);
            //relay if successfull to the controller
            if($result==true)
                return "true";
            return "false";
        }
    }    
    
}