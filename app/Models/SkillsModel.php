<?php
namespace App\Models;
/*
 * <!--
 Project name/Version: LaravelCLC Version: 1
 Module name: SkillModel
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/23/2020
 Synopsis: Module provides the base model of the skills instance
 Version#: 1
 References: N/A
 -->
 */

class SkillsModel{
    
   private $skillId = NULL;
   private $userID;
   private $skill;
   
    /**
     * @return mixed
     */
    public function getSkillId(){
        return $this->skillId;
    }

/**
     * @return mixed
     */
    public function getUserID(){
        return $this->userID;
    }

/**
     * @return mixed
     */
    public function getSkill(){
        return $this->skill;
    }

/**
     * @param mixed $skillId
     */
    public function setSkillId($skillId){
        $this->skillId = $skillId;
    }

/**
     * @param mixed $userID
     */
    public function setUserID($userID){
        $this->userID = $userID;
    }

/**
     * @param mixed $skill
     */
    public function setSkill($skill){
        $this->skill = $skill;
    }

    //constructor method
    public function __construct($id, $skill, $userID){       
        $this->skillId = $id;
        $this->skill = $skill;
        $this->userID = $userID;
     }
     
    
   
   
 
    
    
    
}

