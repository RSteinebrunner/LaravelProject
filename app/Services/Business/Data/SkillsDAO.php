<?php
namespace App\Services\Business\Data;
use Illuminate\Support\Facades\Session;
use App\Models\SkillsModel;

/*
 Project name/Version: LaravelCLC Version: 3
 Module name: Skill Module
 Authors: Roland Steinebrunner, Jack Sidrak
 Date: 2/23/2020
 Synopsis: Module connects to the database and provides information for the skills of the user
 Version#: 1
 References: N/A
 */

//SkillsSecurityDAO class that creates or findes user depending on which method is requested from Skills SecurityService
class SkillsDAO{
        
    public function delete($id, $conn){
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "DELETE FROM `skills` WHERE `id` = '$id'";
            $result = mysqli_query($conn, $sql_statement);
            if($result){
                return true;
            }
            return false;
        }        
    }
  
    
    
    //find all skills in the database
    public function findAllSkills($id, $conn){
        //see if the connection failed
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `skills` WHERE `userId` = '$id'";
            $counter = 0;
            $result = mysqli_query($conn, $sql_statement);
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //create new model to send back
                    $skill = new SkillsModel($row['id'],$row['userId'],$row['skill']);
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
    //creates skills when requested 
    public function create(SkillsModel $skill,$conn){
        
        //get all variables from skills model
        $Skills =$skill->getSkill();        
        $userId = $skill->getUserID();
        //connect to database
        if ($conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `skills` (`id`, `userId`, `skill`) VALUES (NULL, '$userId', '$Skills')";
            if (mysqli_query($conn, $sql_statement)) {
                //echo "New skill created successfully";
                return "true";
            }
        }
        
        
        
    }
    
    
    
   

         
         
    
}