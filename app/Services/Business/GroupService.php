<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 4
Module name: Group Module
Authors: Anthony Clayton
Date: 3/2/2020
Synopsis: Module provides methods passes data to the DAO so it can recieve database information
Version#: 1
References: N/A
-->
*/
use App\Models\GroupModel;
use App\Services\Business\Data\GroupDAO;
use mysqli;

//Service class recieves the sent data from Groupcontroller and calls the appropriate method in DAO to access the database
class GroupService{
   
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function __construct(){
        $this->servername = config("database.connections.mysql.host");
        $this->username = config("database.connections.mysql.username");
        $this->password = config("database.connections.mysql.password");
        $this->dbname = config("database.connections.mysql.database");
    }/**
    * deltes a group
    * @param $id
    * @return string
    */
    public function deleteGroup($id){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //delete the group
        $security = new GroupDAO($conn);
        $result = $security->deleteGroup($id);
       //return if the group was deleted
        return $result;
    }
    public function leaveGroup($groupID,$userID){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //leave the group
        $security = new GroupDAO($conn);
        $result = $security->leaveGroup($groupID, $userID);
        //return if the group was left
        return $result;
    }
    /**
     * 
     * @param  $groupID
     * @param  $userID
     * @return string
     */
    public function joinGroup($groupID,$userID){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //join the group
        $security = new GroupDAO($conn);
        $result = $security->joinGroup($groupID,$userID);
        //return if the member was added
        return $result;
    }
   /**
    * 
    * @return array|\App\Models\GroupModel
    */
    public function findAllGroups(){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new dao
        $security = new GroupDAO($conn);
        //return all groups found
        $result = $security->findAllGroups();
          return $result;
    }
    /**
     * 
     * @return array|\App\Models\GroupModel
     */
    public function findAllOwnerGroups($id){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new dao
        $security = new GroupDAO($conn);
        //return all groups owned by the current logged in user
        $result = $security->findAllOwnerGroups($id);
        return $result;
    }
    /**
     *
     * @return array|\App\Models\GroupModel
     */
    public function findAllParticipation($id){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new dao
        $security = new GroupDAO($conn);
        //return all groups participated in by the current logged in user
        $result = $security->findAllParticipation($id);
        return $result;
    }
    public function findAllMembers($groupid){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new dao
        $security = new GroupDAO($conn);
        //return all group members
        $result = $security->findAllMembers($groupid);
        return $result;
    }
    /**
     *
     * @return array|\App\Models\GroupModel
     */
    public function findGroup($search){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new dao
        $security = new GroupDAO($conn);
        //return groups matching search pararmeter 
        $result = $security->findGroupById($search);
        return $result;
    }
    
    //funtion to pass edited group posting to DAO to completet save
    public function editGroup(GroupModel $group){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using group model
        $security = new GroupDAO($conn);
        $result = $security->update($group);
        return $result;
    } 
    /**
     * adds a new group from an owner user
     * @param GroupModel $group
     */
    public function addGroup(GroupModel $group){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using group model
        $security = new GroupDAO($conn);
        //create a new group 
        $result = $security->create($group);
        return $result;
    } 
  
}