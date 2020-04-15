<?php
namespace App\Models;
/*
 * <!--
 Project name/Version: LaravelCLC Version: 6
 Module name: Group Model
 Authors: Anthony Clayton
 Date: 3/2/2020
 Synopsis: Module provides the base model of the group instance
 Version#: 1
 References: N/A
 -->
 */

class GroupModel
{
   private $groupId = NULL;
   private $name;
   private $description;
   private $userId = NULL;

   
   //constructor method
   public function __construct($id, $name, $description, $userId){
       
       $this->groupId = $id;
       $this->description = $description;
       $this->name = $name;
       $this->userId = $userId;
       
       
   }
   
    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

/**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

/**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

/**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }


   

   
   
    
}

