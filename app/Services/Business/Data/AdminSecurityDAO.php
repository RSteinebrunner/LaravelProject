<?php
namespace App\Services\Business\Data;
use App\Models\UserModel;
use Illuminate\Support\Facades\Session;

/*
 Project name/Version: LaravelCLC Version: 5
 Module name: Administration Module
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 3/9/2020
 Synopsis: connects to the database to handle all administration->user functions
 Version#: 3
 References: N/A
 */

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
class AdminSecurityDAO{
        
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    /**
     * Get the id and check the database to delete the user at that id
     * @param int $id
     * @return boolean
     */
    public function deleteUser($id){
        //check to see if connection to the database is valide
        if ($this->conn->connect_error){
            //if not return an error
            echo "Failed to get databse connection!";
        }
        else{
            //if connection valid run sql statment to delete user form the user table
            $sql_statement = "DELETE FROM `user` WHERE `userId` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                //return true if successful
                    return true;
                }
                //return false if it failed
                return false;
        }           
    }
    
    /**
     * Finds the user by the id and changes their status: the string provided is their current status
     * @param int $id
     * @param string $status
     * @return boolean
     */
    public function updateUserStatus($id,$status){
        //check if the connection to the database is good
        if ($this->conn->connect_error){
            //if the connection fails return an error
            echo "Failed to get databse connection!";
        }
        else{
            //otherwise check to make sure the status is true(user is suspended), set the sql statment to the opposite of the provided status
            if($status == "true"){
                $sql_statement = "UPDATE `user` SET `isSuspended` = 'false' WHERE `userId` = '$id'";  
            }
            //if the status is not true make it true in the databse
            else{
                $sql_statement = "UPDATE `user` SET `isSuspended` = 'true' WHERE `userId` = '$id'";  
            }
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                //run sql and if it was successful return true
                return true;
            }
            //if not successful return false
             return false;            
        }        
    }
    
    /**
     * Change the role from the supplied role to the opposite of the role
     * @param int $id
     * @param string $role
     * @return boolean
     */
    public function changeRole($id,$role){
        //check to make sure the connection to the database is valid
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            //if the role is currently user make it an admin
            if($role == "user"){
                $sql_statement = "UPDATE `user` SET `role` = 'admin' WHERE `userId` = '$id'";
            }
            //if the role is currently admin make it a user
            else{
                $sql_statement = "UPDATE `user` SET `role` = 'user' WHERE `userId` = '$id'";
            }
            $result = mysqli_query($this->conn, $sql_statement);
            //run sql statment and return if successful or not
            if($result){
                return true;
            }
            return false;            
        }        
    }   
    
    /**
     * Find all the users where the id is not equal to your own id
     * @param int $id
     * @return \App\Models\UserModel|array
     */
    public function findAllUsers($id){   
        //check to see if you can connect to the database
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{
            //sql statment checks for all users from user where userId is not the provided id
            $sql_statement = "SELECT * FROM `user` WHERE `userId` <> '$id'";
            $counter=0;
            //run sql statment
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                //as long as there are more users, add then to the array in the appropriate inded
                while($row = mysqli_fetch_assoc($result)){
                    //create user models to store user information in the array
                    $user = new UserModel($row['userId'], $row['username'], $row['password'], $row['firstName'], $row['lastName'], $row['picture'], $row['age'], $row['gender'], $row['address'], $row['hometown'], $row['email'], $row['phoneNumber'], $row['role'], $row['isSuspended']);
                    $array[$counter] = $user;
                    $counter++;
                }
                //if the sql statment found anything and added it to the array return the array
                if(isset($array))
                    return $array;
                //if nothing came back from the sql search return an empty array to keep view from erroring
                $empty=array();
                return $empty;
            }           
        }       
    }      
    
    /**
     * using the username and password check to see if a user with this information exists
     * this is used to log in a person
     * @param string $username
     * @param string $password
     * @return string
     */
    public function findUser($username, $password){
        //check to make sure there is a valid connection
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{
            //search database credentials for user'
            $sql_statement = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
            //runs sql statment
            $result = mysqli_query($this->conn, $sql_statement);
            if ($result) {
                //check to make sure only one is returned
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    //add information to a user model
                    $user = new UserModel($row['userId'], $row['username'], $row['password'], $row['firstName'], $row['lastName'], $row['picture'], $row['age'], $row['gender'], $row['address'], $row['hometown'], $row['email'], $row['phoneNumber'], $row['role'], $row['isSuspended']);
                    //if the user is not suspended add the information to the session and return true
                    if($row['isSuspended'] == "false"){
                        Session::put('User',$user);
                        Session::put('Role', $row['role']);
                        return true;
                    }
                    else{
                        //if the user is suspended return suspended
                        return "Suspended";
                    }
                }
            }
            //if the sql failed return false
            return false;
        }        
    }        
    
    /**
     * Checks to see if the user with this id is present in the database and returns that user
     * @param int $id
     * @return \App\Models\UserModel|string
     */
    public function findUserById($id){
        //check to make sure there is a valid conneciton to the database
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }
        else{        
            $sql_statement = "SELECT * FROM `user` WHERE `userId` = '$id' LIMIT 1";
            //find the result
            $result = mysqli_query($this->conn, $sql_statement);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $user = new UserModel($row['userId'], $row['username'], $row['password'], $row['firstName'], $row['lastName'], $row['picture'], $row['age'], $row['gender'], $row['address'], $row['hometown'], $row['email'], $row['phoneNumber'], $row['role'], $row['isSuspended']);                    
                }
                return $user;
            }
            return true;
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