<?php
namespace App\Models;
/*
 * <!--
 Project name/Version: LaravelCLC Version: 6
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

    //constructor method
    public function __construct($id, $userID,$skill){       
        $this->skillId = $id;
        $this->skill = $skill;
        $this->userID = $userID;
     }
     
    
   
   
 
    
    
    
}

