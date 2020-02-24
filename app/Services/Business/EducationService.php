<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 3
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
   
    public function deleteEducation($id){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //delete the user
         $security = new EducationDAO();
        $result = $security->delete($id, $conn);
       //return if the user was deleted
        return $result;
    }
   
    public function findAllEducation($id){

        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //check for user
        $security = new EducationDAO();
        $result = $security->findAllEducation($id, $conn);
        
        return $result;
        
    }
    public function addEducation(EducationModel $edu, $id){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new user in database using education model
        $security = new EducationDAO();
        $result = $security->create($edu,$conn,$id);
        return $result;
    } 
    
   
}