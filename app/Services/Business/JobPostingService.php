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
   
    public function deletePost($id){
        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //delete the user
        $security = new JobPostingDAO($conn);
        $result = $security->delete($id);
       //return if the user was deleted
        return $result;
    }
   
    public function findAllJobs(){

        //Set up connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new dao
        $security = new JobPostingDAO($conn);
        $result = $security->findAllJobs();
        
        return $result;
        
    }
    public function addPost(JobPostingModel $post){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new user in database using education model
        $security = new JobPostingDAO($conn);
        $result = $security->create($post);
        return $result;
    } 
    
    public function editPost(JobPostingModel $post){
        //Database Connection
        $conn = new mysqli("localhost","root","root","laraveldb");
        //make new user in database using education model
        $security = new JobPostingDAO($conn);
        $result = $security->edit($post);
        return $result;
    } 
    
   
}