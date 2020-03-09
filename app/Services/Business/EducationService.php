<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 4
Module name: Education Module
Authors: Anthony Clayton
Date: 2/17/2020
Synopsis: Module provides methods passes data to the DAO so it can recieve database information
Version#: 1
References: N/A
-->
*/
use mysqli;
use App\Services\Business\Data\EducationDAO;
use App\Models\EducationModel;

//securityService class recieves the sent data from Educationcontroller and calls the appropriate method in DAO to access the database
class EducationService{
   
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
    public function deleteEducation($id){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //delete the user
         $security = new EducationDAO($conn);
        $result = $security->delete($id);
       //return if the user was deleted
        return $result;
    }
   
    public function findAllEducation($id){

        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //check for user
        $security = new EducationDAO($conn);
        $result = $security->findAllEducation($id);
        
        return $result;
        
    }
    public function addEducation(EducationModel $edu, $id){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using education model
        $security = new EducationDAO($conn);
        $result = $security->create($edu,$id);
        return $result;
    } 
    
   
}