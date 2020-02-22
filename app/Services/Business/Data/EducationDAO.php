<?php
namespace App\Services\Business\Data;
use Illuminate\Support\Facades\Session;
use App\Models\EducationModel;

/*
 Project name/Version: LaravelCLC Version: 1
 Module name: DAO
 Authors: Roland Steinebrunner, Jack Sidrak, Anthony Clayton
 Date: 2/15/2020
 Synopsis: Module connects to the database and provides information for the education of the user
 Version#: 1
 References: N/A
 */

//securityDAO class that creates or findes user depending on which method is requested from SecurityService
class EducationDAO{
        
    public function delete($id, $conn){
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "DELETE FROM `education` WHERE `id` = '$id'";
            $result = mysqli_query($conn, $sql_statement);
            if($result){
                return true;
            }
            return false;
        }
        
    }
  
    
    
    //find all users in the database
    public function findAllEducation($id, $conn){
        //see if the connection failed
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `education` WHERE `user_userId` = '$id'";
            $counter = 0;
            $result = mysqli_query($conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new model to send back
                    $edu = new EducationModel($row['id'],$row['educationYears'], $row['degree'], $row['school']);
                    $array[$counter] = $edu;
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
    //creates education when requested 
    public function create(EducationModel $edu,$conn, $id){
        
        //get all variables from education model
        $years =$edu->getEducationYears();
        $degree = $edu->getDegree();
        $school = $edu->getSchool();
        
        
        //connect to database
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `education` (`id`, `educationYears`, `degree`, `school`, `user_userId`) VALUES (NULL, '$years', '$degree', '$school', '$id')";
            if (mysqli_query($conn, $sql_statement)) {
                //echo "New user created successfully";
                return "true";
            }
        }
        
        
        
    }
    
    
    
   

         
         
    
}