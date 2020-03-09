<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Skill Module
Authors: Roland Steinebrunner, Jack Sidrak
Date: 2/23/2020
Synopsis: Module provides methods passes data to the DAO so it can recieve database information
Version#: 1
References: N/A
-->
*/
use mysqli;
use App\Services\Business\Data\SkillsDAO;
use App\Models\SkillsModel;

//Skill securityService class recieves the sent data from Skills controller and calls the appropriate method in DAO to access the database
class SkillsSecurityService{
   
    public function deleteSkills($id){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //delete the skill
        $security = new SkillsDAO();
        $result = $security->delete($id, $conn);
       //return if the skill was deleted
        return $result;
    }
   
    public function findAllSkills($id){

        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //check for skill
        $security = new SkillsDAO();
        $result = $security->findAllSkills($id, $conn);
        
        return $result;
        
    }
    public function addSkill(SkillsModel $skill, $id){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new skill in database using skills model
        $security = new SkillsDAO();
        $result = $security->create($skill,$conn,$id);
        return $result;
    } 
    
   
}