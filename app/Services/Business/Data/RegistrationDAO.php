<?php
namespace App\Services\Business\Data;
use App\Models\UserModel;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Registration Module
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/23/2020
 Synopsis: Module connects to the database and provides information to allow for user creation upon registering
 Version#: 1
 References: N/A
 */

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
class RegistrationDAO{
    
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    //creates the user in the database
    public function makeUser(UserModel $user){
        //get all variables from user model
        $firstName =$user->getFirstName();
        $lastName = $user->getLastName();
        $username = $user->getUsername();
        $password = $user->getPassword();
        $age = $user->getAge();
        $email = $user->getEmail();
        $picture = null;
        $gender = $user->getGender();
        $address = $user->getAddress();
        $hometown = $user->getHometown();
        $phoneNumber = $user->getPhoneNumber();
        $role = $user->getRole();
        $suspended=$user->getStatus();
        
        //connect to database
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{
            //add user
            $sql_statement_user = "INSERT INTO `user` (`username`,`password`,`firstName`,`lastName`, `picture`, `age`, `gender`, `address`, `hometown`, `email`, `phoneNumber`, `role`, `isSuspended` ) VALUES ('$username', '$password', '$firstName', '$lastName', '$picture', '$age', '$gender', '$address', '$hometown', '$email', '$phoneNumber', '$role', '$suspended')";
            if (mysqli_query($this->conn, $sql_statement_user)) {
                //echo "New user created successfully";
                return true;
            }
        }
    }
    //find user by username -- will be used to check for duplicate profile with same username
    public function findByUsername($username){
        //establic connectionto the database(try to put this in the security service)
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{
            $sql_statement = "SELECT * FROM `user` WHERE `username` = '$username' LIMIT 1";
            $result = mysqli_query($this->conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    return true;
                }
            }
            return false;
        }
    } 
}