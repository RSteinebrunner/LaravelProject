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

//securityService class recieves the sent data from Educationcontroller and calls the appropriate method in DAO to access the database
class GroupService{
   /**
    * deltes a group
    * @param $id
    * @return string
    */
    public function deleteGroup($id){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //delete the user
        $security = new GroupDAO($conn);
        $result = $security->delete($id);
       //return if the user was deleted
        return $result;
    }
   /**
    * 
    * @return array|\App\Models\GroupModel
    */
    public function findAllGroups(){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new dao
        $security = new GroupDAO($conn);
        $result = $security->findAllGroups();
          return $result;
    }
    /**
     * 
     * @return array|\App\Models\GroupModel
     */
    public function findAllOwnerGroups($id){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new dao
        $security = new GroupDAO($conn);
        $result = $security->findAllOwnerGroups($id);
        return $result;
    }
    /**
     *
     * @return array|\App\Models\GroupModel
     */
    public function findGroup($search){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new dao
        $security = new GroupDAO($conn);
        $result = $security->findGroup($search);
        return $result;
    }
    /**
     * adds a new group from an owner user
     * @param GroupModel $group
     */
    public function addGroup(GroupModel $group){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new user in database using group model
        $security = new GroupDAO($conn);
        $result = $security->create($group);
        return $result;
    } 
  
}