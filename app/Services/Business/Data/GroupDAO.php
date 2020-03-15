<?php
namespace App\Services\Business\Data;
use App\Models\GroupModel;

/*
 Project name/Version: LaravelCLC Version: 4
 Module name: Group Module
 Authors: Anthony Clayton, Roland Steinebrunner
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
    
    /**
     * Delete the group with the given Id
     * @param int $id
     * @return string|boolean
     */
    public function deleteGroup($id){
        if ($this->conn->connect_error){
            //check the connection
           return "Failed to get databse connection!";
        }else{
            //running the statement
            $sql_statement = "DELETE FROM `groups` WHERE `groupId` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);//running the statement
            $sql_statement2 = "DELETE FROM `groupmembers` WHERE `groupId` = '$id'";
            $result2 = mysqli_query($this->conn, $sql_statement2);
            if($result && $result2){
                //returning if the user was deleted
                return true;
            } 
        }
        
    } 
    /**
     * remove the user from the group with the given params
     * @param int $groupID
     * @param int $userID
     * @return string|boolean
     */
    public function leaveGroup($groupID, $userID){
        if ($this->conn->connect_error){
            //check the connection
            return "Failed to get databse connection!";
        }else{
            //running the statement
            $sql_statement = "DELETE FROM `groupmembers` WHERE `groupId` = '$groupID' AND `userID` = '$userID'";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                //returning if the group was left
                return true;
            }
        }
        
    } 
    /**
     * Join the group with the given params
     * @param int $groupID
     * @param int $userID
     * @return string|boolean
     */
    public function joinGroup($groupID,$userID){
        if ($this->conn->connect_error){
            //check the connection
            return "Failed to get databse connection!";
        }else{
            //if duplicate is found do nothing
            $sql_search = "SELECT * FROM `groupmembers` WHERE `userId` = '$userID' AND `groupId` = '$groupID' LIMIT 1";
            $result = mysqli_query($this->conn, $sql_search);
            if ($result) {
                if (mysqli_num_rows($result) == 1) {
                    return true;
                }
            }
            //otherwise add to the database
            $sql_statement = "INSERT INTO `groupmembers` (`userId`, `groupId`) VALUES ('$userID', '$groupID')";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                //returning if the user was added
                return true;
            }
            else 
                return "failed to add";
        }
        
    } 
    
    /**
     * Show all groups in the database
     * @return \App\Models\GroupModel|array
     */
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
    //find all groups the user is a part of in the database
    public function findAllParticipation($id){
        //see if the connection failed
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT groups.groupId, groupName, description, groupmembers.userId FROM groups 
                JOIN groupmembers
                ON groups.groupId = groupmembers.groupId
                WHERE groupmembers.userId = '$id'";
            $counter = 0;
            $result = mysqli_query($this->conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new model to send back
                    $group = new GroupModel($row['groupId'],$row['groupName'], $row['description'],$row['userId']);
                    //add the new models to an array to return
                    $array[$counter] = $group;
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
    //finds all the users that are a part of a group
    public function findAllMembers($groupID){
        //see if the connection failed
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT groups.groupId, groupName, description, groupmembers.userId FROM groups
                JOIN groupmembers
                ON groups.groupId = groupmembers.groupId
                WHERE groupmembers.groupId = '$groupID'";
            $counter = 0;
            $result = mysqli_query($this->conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new model to send back
                    $group = new GroupModel($row['groupId'],$row['groupName'], $row['description'],$row['userId']);
                    //add the new models to an array to return
                    $array[$counter] = $group;
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
    
    //Find goup by groupID
    public function findGroupById($id){
        //see if the connection failed
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `groups` WHERE `groupId` = '$id'";
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
                if(isset($array)){
                    //if something is in the array return it
                    return $array;
                }
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
                return true;
            }
        }      
    }
    
    //modifies post when requested
    public function update(GroupModel $group){
        
        //get all variables from education model
        $groupId = $group->getGroupId();
        $groupName = $group->getName();
        $description = $group->getDescription();
        
        //connect to database
        if ($this->conn->connect_error){
            return "please connect";
        }else{
            //insert into db
            $sql_statement = "UPDATE `groups` SET `groupName` = '$groupName', `description` = '$description' WHERE `groups`.`groupId` = $groupId;";
            if (mysqli_query($this->conn, $sql_statement)) {
                return true;
            }
            return "failed to insert";
        }
    }
    
   

         
         
    
}