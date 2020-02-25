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
    
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
        
    public function delete($id){
        if ($this->conn->connect_error){
            //check the connection
            echo "Failed to get databse connection!";
        }else{
            //running the statement
            $sql_statement = "DELETE FROM `jobposting` WHERE `id` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                //returning if the user was deleted
                return "true";
            } 
        }
        
    }
  
    
    
    //find all users in the database
    public function findAllJobs(){
        //see if the connection failed
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `jobposting`";
            $counter = 0;
            $result = mysqli_query($this->conn, $sql_statement);
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
    //creates post when requested 
    public function create(JobPostingModel $post){
        
        //get all variables from education model
        $company = $post->getCompany();
        $position = $post->getPosition();
        $description = $post->getDescription();
        $requirements = $post->getRequirements();
        $pay = $post->getPay();
        $postingDate = $post->getPostingDate();
        
        
        //connect to database
        if ($this->conn->connect_error){
            return "please connect";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `jobposting` (`id`, `company`, `position`, `description`, `requirements`, `pay`, `postingDate`) VALUES (NULL, '$company', '$position', '$description', '$requirements', '$pay', '$postingDate')";
            if (mysqli_query($this->conn, $sql_statement)) {
                //echo "New user created successfully";
                return "true";
            }
        }
        
        
        
    }
    
    //modifies post when requested
    public function edit(JobPostingModel $post,$conn){
        
        //get all variables from education model
        $id = $post->getJobId();
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
            $sql_statement = "UPDATE `jobposting` SET `company` = '$company', `position` = '$position', `description` = '$description', `requirements` = '$requirements', `pay` = '$pay', `postingDate` = '$postingDate' WHERE `jobposting`.`id` = '$id';";
            if (mysqli_query($conn, $sql_statement)) {
                //echo "New user created successfully";
                return "true";
            }
        }
        
        
        
    }
    
   

         
         
    
}