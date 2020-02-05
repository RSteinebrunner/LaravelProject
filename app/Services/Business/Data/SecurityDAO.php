<?php
namespace App\Services\Business\Data;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;

/*
 Project name/Version: LaravelCLC Version: 1
 Module name: DAO
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 1/19/2020
 Synopsis: Module connects to the database and provides information to authenticate users and allow for user creation upon registering
 Version#: 1
 References: N/A
 */

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
class SecurityDAO{
    
    //finds users in database and returns true if found
    public function findUser($username, $password,$conn){
        //establic connectionto the database(try to put this in the security service)
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
           // echo "Got databse connection!";
            //search database credentials for user'
            $sql_statement = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
            $result = mysqli_query($conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $user = new UserModel($row['userId'], $row['username'], $row['password'], $row['firstName'], $row['lastName'], $row['picture'], $row['age'], $row['gender'], $row['address'], $row['hometown'], $row['email'], $row['phoneNumber'], $row['role'], $row['isSuspended']);
                    if($row['isSuspended'] == "false")
                    {
                        Session::put('User',$user);
                        Session::put('Role', $row['role']);
                        return "true";
                    }
                    else{
                        return "Suspended";
                    }
                }
            }
            return "false";
        }        
    }
    
    //creates user when requested from user registeration page
    public function makeUser(UserModel $user,$conn){
       
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
         if ($conn->connect_error){
             echo "Failed to get databse connection!";
         }else{
             //add user
             $sql_statement_user = "INSERT INTO `user` (`username`,`password`,`firstName`,`lastName`, `picture`, `age`, `gender`, `address`, `hometown`, `email`, `phoneNumber`, `role`, `isSuspended` ) VALUES ('$username', '$password', '$firstName', '$lastName', '$picture', '$age', '$gender', '$address', '$hometown', '$email', '$phoneNumber', '$role', '$suspended')"; 
             if (mysqli_query($conn, $sql_statement_user)) {
                 //echo "New user created successfully";
                 return true;
             }else{
                 echo "Error: " . $sql_statement_user . "<br>" . mysqli_error($conn);
             }
         }
        return false;

         
         
    }
}