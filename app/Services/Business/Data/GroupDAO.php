<?php
namespace App\Services\Business\Data;
use App\Models\GroupModel;

/*
 Project name/Version: LaravelCLC Version: 4
 Module name: Group Module
 Authors: Anthony Clayton
 Date: 3/2/2020
 Synopsis: Module connects to the database and provides information for the groups
 Version#: 1
 References: N/A
 */

//GroupDAO class that creates or finds groups depending on which method is requested from SecurityService
class GroupDAO{
    
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
        
    public function delete($id){
        if ($this->conn->connect_error){
            //check the connection
           return "Failed to get databse connection!";
        }else{
            //running the statement
            $sql_statement = "DELETE FROM `groups` WHERE `groupId` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                //returning if the user was deleted
                return "true";
            } 
        }
        
    }    
    
    //find all groups in the database
    public function findAllGroups(){
        //see if the connection failed
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `groups`";
            $counter = 0;
            $result = mysqli_query($this->conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new model to send back
                    $post = new GroupModel($row['groupId'],$row['groupName'], $row['description'],$row['userId']);
                    //add the new models to an array to return
                    $array[$counter] = $post;
                    $counter++;
                }
                if(isset($array))
                    //if something is in the array return it
                    return $array;
                //return if empty
                $empty=array();
                return $empty;
            }
            
        }
        
    }
    //find all groups in the database which the user owns
    public function findAllOwnerGroups($id){
        //see if the connection failed
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `groups` WHERE `userId` = '$id'";
            $counter = 0;
            $result = mysqli_query($this->conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new model to send back
                    $post = new GroupModel($row['groupId'],$row['groupName'], $row['description'],$row['userId']);
                    //add the new models to an array to return
                    $array[$counter] = $post;
                    $counter++;
                }
                if(isset($array))
                    //if something is in the array return it
                    return $array;
                    //return if empty
                    $empty=array();
                    return $empty;
            }
            
        }
        
    }
    public function findGroup($search){
        //see if the connection failed
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `groups` WHERE `groupName` LIKE '%$search%' OR `description` LIKE '%$search%'";
            $counter = 0;
            $result = mysqli_query($this->conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new model to send back
                    $post = new GroupModel($row['groupId'],$row['groupName'], $row['description'],$row['userId']);
                    //add the new models to an array to return
                    $array[$counter] = $post;
                    $counter++;
                }
                if(isset($array))
                    //if something is in the array return it
                    return $array;
                    //return if empty
                    $empty=array();
                    return $empty;
            }
            
        }
        
    }
    //creates group when requested 
    public function create(GroupModel $group){
        
        //get all variables from group model
        $name = $group->getName();
        $description = $group->getDescription();
        $userId = $group->getUserId();
        
        
        //connect to database
        if ($this->conn->connect_error){
            return "please connect";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `groups` (`groupId`, `groupName`, `description`, `userId`) VALUES (NULL, '$name', '$description', '$userId')";
            if (mysqli_query($this->conn, $sql_statement)) {
                //echo "New group created successfully";
                return "true";
            }
        }
        
        
        
    }
    
   
    
   

         
         
    
}