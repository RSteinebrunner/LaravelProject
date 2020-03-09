<?php
namespace App\Services\Business;
/*
<!--  
Project name/Version: LaravelCLC Version: 3
Module name: Job Posting Module
Authors: Anthony Clayton
Date: 2/23/2020
Synopsis: Module provides methods passes data to the DAO so it can recieve database information
Version#: 1
References: N/A
-->
*/
use mysqli;
use App\Services\Business\Data\JobPostingDAO; 
use App\Models\JobPostingModel;

//securityService class recieves the sent data from Educationcontroller and calls the appropriate method in DAO to access the database
class JobPostingService{
   
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
    public function deletePost($id){
        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //delete the user
        $security = new JobPostingDAO($conn);
        $result = $security->delete($id);
       //return if the user was deleted
        return $result;
    }
   
    public function findAllJobs(){

        //Set up connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new dao
        $security = new JobPostingDAO($conn);
        $result = $security->findAllJobs();
        
        return $result;
        
    }
    public function addPost(JobPostingModel $post){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using education model
        $security = new JobPostingDAO($conn);
        $result = $security->create($post);
        return $result;
    } 
    
    //locate a job in the database by id and retrieve the information
    public function findJobById($id){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using education model
        $security = new JobPostingDAO($conn);
        $result = $security->findJobById($id);
        return $result;
    } 
    
    public function editPost(JobPostingModel $post){
        //Database Connection
        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
        //make new user in database using education model
        $security = new JobPostingDAO($conn);
        $result = $security->edit($post);
        return $result;
    } 
    
   
}