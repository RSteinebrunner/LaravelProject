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
class SkillsService{
    private $servername;
    private $username;
    private $password;
    private $dbname;
    
    public function __construct(){
        $this->servername = config("database.connections.mysql.host");
        $this->username = config("database.connections.mysql.username");
        $this->password = config("database.connections.mysql.password");
        $this->dbname = config("database.connections.mysql.database");
    }
    public function deleteSkills($id){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //delete the skill
        $security = new SkillsDAO($conn);
        $result = $security->delete($id);
       //return if the skill was deleted
        return $result;
    }
   
    public function findAllSkills($id){

        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //check for skill
        $security = new SkillsDAO($conn);
        $result = $security->findAllSkills($id);
        
        return $result;
        
    }
    public function addSkill(SkillsModel $skill){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new skill in database using skills model
        $security = new SkillsDAO($conn);
        $result = $security->create($skill);
        return $result;
    } 
    
   
}