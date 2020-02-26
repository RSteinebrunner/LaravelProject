<?php
namespace App\Services\Business\Data;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\SkillsModel;

/*
 Project name/Version: LaravelCLC Version: 4
 Module name: Skill Module
 Authors: Roland Steinebrunner, Jack Sidrak
 Date: 2/25/2020
 Synopsis: Module connects to the database and provides information for the skills of the user
 Version#: 2
 References: N/A
 */

//SkillsSecurityDAO class that creates or findes user depending on which method is requested from Skills SecurityService
class SkillsDAO{
        
    
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function delete($id){
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "DELETE FROM `skills` WHERE `id` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            if($result){
                return true;
            }
            return false;
        }        
    }
  
    
    
    //find all skills in the database
    public function findAllSkills($id){
        //see if the connection failed
        Log::info("Entering SkillsDAO.findAllSkills()");
        
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            $sql_statement = "SELECT * FROM `skills` WHERE `userId` = '$id'";
            $result = mysqli_query($this->conn, $sql_statement);
            $counter = 0;
            $counter2 = 0;
            //run the statment
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    //if the array reaches 5 elements, add the array to the final returned array
                    if($counter==5){
                        //add array of educations to submitted array
                        $array[$counter2]=$skills;
                        //reset the educations array
                        $skills = array();
                        //reset counters
                        $counter = 0;
                        $counter2++;
                    }
                    if($counter<5)
                    {
                        //new model is made
                        $skill = new SkillsModel($row['id'],$row['userId'],$row['skill']);
                        $skills[$counter] = $skill;
                        $counter++;
                    }
                }
                if($counter>0)
                {
                    $array[]=$skills;
                    
                }
                if(isset($array)){
                    Log::info("Exiting SkillsDAO.findAllSkills with Final Array ", $array);
                    return $array;
                }
                //return if empty
                $empty=array();
                return $empty;
            }
            
        }
        
    }
    //creates skills when requested 
    public function create(SkillsModel $skill){
        
        //get all variables from skills model
        $Skills =$skill->getSkill();        
        $userId = $skill->getUserID();
        //connect to database
        if ($this->conn->connect_error){
            echo "Failed to get databse connection!";
        }else{
            //insert into db
            $sql_statement = "INSERT INTO `skills` (`id`, `userId`, `skill`) VALUES (NULL, '$userId', '$Skills')";
            if (mysqli_query($this->conn, $sql_statement)) {
                //echo "New skill created successfully";
                return "true";
            }
        }
        
        
        
    }
    
    
    
   

         
         
    
}