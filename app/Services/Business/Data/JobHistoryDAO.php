<?php
namespace App\Services\Business\Data;
use Illuminate\Support\Facades\Session;
use App\Models\JobHistoryModel;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: JobHistory Module
 Authors: Jack Sidrak
 Date: 2/23/2020
 Synopsis: Module connects to the database and provides information for the JobHistory of the user
 Version#: 1
 References: N/A
 */

//JobHistory DAO class that creates or findes user depending on which method is requested from JobHistory Service
class JobHistoryDAO{
        
    public function delete($id, $conn){
        if ($conn->connect_error){
            return "false";        
        }else{
            $sql_statement = "DELETE FROM `jobhistory` WHERE `id` = '$id'";
            $result = mysqli_query($conn, $sql_statement);
            if($result){
                return "true";
            }
            return "false";
        }        
    }    
    
    //find all JobHistory in the database
    public function findAllJobHistory($id, $conn){
        //see if the connection failed
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `jobhistory` WHERE `userId` = '$id'";
            $counter = 0;
            $result = mysqli_query($conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new JobHistory model to send back
                    $skill = new JobHistoryModel($row['id'],$row['userId'],$row['company'],$row['position'],$row['startDate'],$row['endDate'],$row['description']);
                    $array[$counter] = $skill;
                    $counter++;
                }
                if(isset($array))
                    return $array;
                //return if empty
                $empty=array();
                return $empty;
            }            
        }       
    }
    
    //creates JobHistory when requested 
    public function create(JobHistoryModel $JobHistory,$conn){
        
        //get all variables from JobHistory model      
        $userId =$JobHistory->getUserID();
        $company =$JobHistory->getCompany();
        $position =$JobHistory->getPosition();
        $startDate =$JobHistory->getStartDate();
        $endDate =$JobHistory->getEndDate();
        $description =$JobHistory->getDescription();
        
        //connect to database
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
            return "connection";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `jobhistory` (`id`, `userId`, `company`, `position`, `startDate`, `endDate`, `description`) VALUES (NULL, '$userId', '$company', '$position', '$startDate', '$endDate', '$description')";
            if (mysqli_query($conn, $sql_statement)) {
                return "true";
            }
        }
        return "false";
        
        
        
    }
    
    
    
   

         
         
    
}