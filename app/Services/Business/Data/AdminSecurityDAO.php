<?php
namespace App\Services\Business\Data;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Administration Module
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/23/2020
 Synopsis: connects to the database to handle all administrationm->user functions
 Version#: 2
 References: N/A
 */

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
class AdminSecurityDAO{
        
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    //delete a user by id
    public function deleteUser($id){
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{
            $sql_statement = "DELETE FROM `user` WHERE `userId` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                    return true;
                }
                return false;
        }           
    }
    
    public function updateUserStatus($id,$status){
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{
            if($status == "true"){
                $sql_statement = "UPDATE `user` SET `isSuspended` = 'false' WHERE `userId` = '$id'";  
            }
            else{
                $sql_statement = "UPDATE `user` SET `isSuspended` = 'true' WHERE `userId` = '$id'";  
            }
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                return true;
            }
             return false;            
        }        
    }
    
    public function changeRole($id,$role){
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            if($role == "user"){
                $sql_statement = "UPDATE `user` SET `role` = 'admin' WHERE `userId` = '$id'";
            }
            else{
                $sql_statement = "UPDATE `user` SET `role` = 'user' WHERE `userId` = '$id'";
            }
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                return true;
            }
            return false;            
        }        
    }   
    
    //find all users in the database
    public function findAllUsers($id){       
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{
            //search database for all users except ID
            $sql_statement = "SELECT * FROM `user` WHERE `userId` <> '$id'";
            $counter=0;
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $user = new UserModel($row['userId'], $row['username'], $row['password'], $row['firstName'], $row['lastName'], $row['picture'], $row['age'], $row['gender'], $row['address'], $row['hometown'], $row['email'], $row['phoneNumber'], $row['role'], $row['isSuspended']);
                    $array[$counter] = $user;
                    $counter++;
                }
                if(isset($array))
                    return $array;
                $empty=array();
                return $empty;
            }           
        }       
    }      
    
    //finds users in database and returns true if found
    public function findUser($username, $password){
        //establic connectionto the database(try to put this in the security service)
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{
            //search database credentials for user'
            $sql_statement = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
            $result = mysqli_query($this->conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $user = new UserModel($row['userId'], $row['username'], $row['password'], $row['firstName'], $row['lastName'], $row['picture'], $row['age'], $row['gender'], $row['address'], $row['hometown'], $row['email'], $row['phoneNumber'], $row['role'], $row['isSuspended']);
                    if($row['isSuspended'] == "false"){
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
    
    public function findUserById($id){
        //establic connectionto the database(try to put this in the security service)
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{        
            //search database credentials for user'
            $sql_statement = "SELECT * FROM `user` WHERE `userId` = '$id' LIMIT 1";
            $result = mysqli_query($this->conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $user = new UserModel($row['userId'], $row['username'], $row['password'], $row['firstName'], $row['lastName'], $row['picture'], $row['age'], $row['gender'], $row['address'], $row['hometown'], $row['email'], $row['phoneNumber'], $row['role'], $row['isSuspended']);                    
                }
                return $user;
            }
            return "false";
        }
    }
    
    //update the user
    public function updateUser(UserModel $user){
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
        $id=$user->getId();
        $status = $user->getStatus();
        
        //connect to database
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            //update user          
            $sql_statement_user = "UPDATE `user` SET `username` = '$username', `password` = '$password', `firstName` = '$firstName', `lastName` = '$lastName', `age` = '$age', `gender` = '$gender', `address` =  '$address', `hometown` = '$hometown', `email` = '$email', `phoneNumber` = '$phoneNumber', `role` = '$role', `isSuspended` = '$status' WHERE `userId` = $id";
            if (mysqli_query($this->conn, $sql_statement_user)) {
                //user updated successfully
                Session::put('User',$user);
                return true;
            }
            else{
                echo "Error: " . $sql_statement_user . "<br>" . mysqli_error($this->conn);
            }
        }
        return false;
    }

    
    
}