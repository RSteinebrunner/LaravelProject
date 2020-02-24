<?php
namespace App\Services\Business\Data;
use Illuminate\Support\Facades\Session;
use App\Models\JobPostingModel;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Job Posting Module
 Authors:Anthony Clayton
 Date: 2/20/2020
 Synopsis: Module connects to the database and provides information for the job posting
 Version#: 1
 References: N/A
 */

//JobPostingDAO class that creates or finds jobs depending on which method is requested from SecurityService
class JobPostingDAO{
        
    public function delete($id, $conn){
        if ($conn->connect_error){
            //check the connection
            echo "Failed to get databse connection!";
        }else{
            //running the statement
            $sql_statement = "DELETE FROM `jobposting` WHERE `id` = '$id'";
            $result = mysqli_query($conn, $sql_statement);
            if($result){
                //returning if the user was deleted
                return "true";
            } 
        }
        
    }
  
    
    
    //find all users in the database
    public function findAllJobs($conn){
        //see if the connection failed
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `jobposting`";
            $counter = 0;
            $result = mysqli_query($conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new model to send back
                    $post = new JobPostingModel($row['id'],$row['company'], $row['position'], $row['description'], $row['requirements'], $row['pay'], $row['postingDate']);
                    //add the new models to an array to return
                    $array[$counter] = $post;
                    $counter++;
                }
                if(isset($array))
                    //if something is in the array return it
                    return $array;
                //return if empty
                $empty=array();
                return $empty;
            }
            
        }
        
    }
    //creates education when requested 
    public function create(JobPostingModel $post,$conn){
        
        //get all variables from education model
        $company = $post->getCompany();
        $position = $post->getPosition();
        $description = $post->getDescription();
        $requirements = $post->getRequirements();
        $pay = $post->getPay();
        $postingDate = $post->getPostingDate();
        
        
        //connect to database
        if ($conn->connect_error){
            return "please connect";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `jobposting` (`id`, `company`, `position`, `description`, `requirements`, `pay`, `postingDate) VALUES (NULL, '$company', '$position', '$description', '$requirements', '$pay', '$postingDate')";
            if (mysqli_query($conn, $sql_statement)) {
                //echo "New user created successfully";
                return "true";
            }
        }
        
        
        
    }
    
    
    
   

         
         
    
}