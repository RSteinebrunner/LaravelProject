<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 3
Module name: JobHistory Module
Authors: Jack Sidrak
Date: 2/23/2020
Synopsis: Module provides methods passes data to the DAO so it can recieve database information
Version#: 1
References: N/A
-->
*/
use mysqli;
use App\Services\Business\Data\JobHistoryDAO;
use App\Models\JobHistoryModel;

//JobHistory Service class recieves the sent data from jobs controller and calls the appropriate method in DAO to access the database
class JobHistoryService{
   
    public function deleteSkills($id){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //delete the JobHistory
        $security = new JobHistoryDAO();
        $result = $security->delete($id, $conn);
        //return if the JobHistory was deleted
        return $result;
    }
   
    public function findAllJobHistory($id){

        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //check for JobHistory
        $security = new JobHistoryDAO();
        $result = $security->findAllJobHistory($id, $conn);
        
        return $result;
        
    }
    public function addJobHistory(JobHistoryModel $JobHistory, $id){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new JobHistory in database using JobHistory model
        $security = new JobHistoryDAO();
        $result = $security->create($JobHistory,$conn,$id);
        return $result;
    } 
    
   
}