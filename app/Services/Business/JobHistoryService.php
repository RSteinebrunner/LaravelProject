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
    public function deleteJobHistory($id){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //delete the JobHistory
        $security = new JobHistoryDAO($conn);
        $result = $security->delete($id);
        //return if the JobHistory was deleted
        return $result;
    }
   
    public function findAllJobHistory($id){

        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //check for JobHistory
        $security = new JobHistoryDAO($conn);
        $result = $security->findAllJobHistory($id);
        
        return $result;
        
    }
    public function addJobHistory(JobHistoryModel $JobHistory){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new JobHistory in database using JobHistory model
        $security = new JobHistoryDAO($conn);
        $result = $security->create($JobHistory);
        return $result;
    } 
    
   
}