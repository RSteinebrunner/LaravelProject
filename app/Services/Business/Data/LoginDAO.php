<?php
namespace App\Services\Business\Data;
use App\Models\UserModel;

/*
 Project name/Version: LaravelCLC Version: 6
 Module name: Login Module
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/23/2020
 Synopsis: Connects to the database to authenticate users
 Version#: 1
 References: N/A
 */

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
class LoginDAO{
    
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    //finds users in database and returns true if found
    public function findUser($username, $password){
        //establic connectionto the database(try to put this in the security service)
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            //search database credentials for user'
            $sql_statement = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
            $result = mysqli_query($this->conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $user = new UserModel($row['userId'], $row['username'], $row['password'], $row['firstName'], $row['lastName'], $row['picture'], $row['age'], $row['gender'], $row['address'], $row['hometown'], $row['email'], $row['phoneNumber'], $row['role'], $row['isSuspended']);
                    return $user;
                }
            }
        }        
    }

}